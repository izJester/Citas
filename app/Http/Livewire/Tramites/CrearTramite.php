<?php

namespace App\Http\Livewire\Tramites;

use Filament\Forms;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Filament\Forms\Components\Wizard;
use App\Models\Tramite;
use Squire\Models\Country;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\URL;
use App\Models\Motivo;
use Closure;

use App\Classes\IpgBdv;
use App\Classes\IpgBdvPaymentRequest;



class CrearTramite extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $nombres;
    public $apellidos;
    public $tipo_cedula;
    public $cedula;
    public $nucleo;
    public $carrera;
    public $direccion;
    public $telefono;
    public $email;
    public $pais;
    public $fecha_egreso;
    public $motivos;

    public $paises;
 
    public function mount(): void 
    {
        $this->paises = Country::all();
        $this->form->fill();
    } 

    protected function getFormSchema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make('Datos')
                    ->description('Personales y Academicos')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Forms\Components\TextInput::make('nombres')
                            ->label('Nombres')
                            ->default(old('nombres'))
                            ->required(),
                        Forms\Components\TextInput::make('apellidos')
                            ->label('Apellidos')
                            ->default(old('apellidos'))
                            ->required(),
                        Forms\Components\Select::make('tipo_cedula')
                            ->label('Tipo de documento de identidad')
                            ->default(old('tipo_cedula'))
                            ->required()
                            ->options([
                                'V' => 'Venezolano',
                                'E' => 'Extranjero',
                                'P' => 'Pasaporte',
                            ]),
                        Forms\Components\TextInput::make('cedula')
                            ->label('Número de documento de identidad')
                            ->default(old('cedula'))
                            ->required(),
                        Forms\Components\Select::make('nucleo')
                            ->label('Núcleo')
                            ->default(old('nucleo'))
                            ->required()
                            ->options([
                                'chuao' => 'Chuao',
                                'maracay' => 'Maracay',
                                'guaira' => 'La Guaira',
                                'teques' => 'Los Teques'
                            ]),
                        Forms\Components\Select::make('carrera')
                            ->label('Carrera cursada')
                            ->default(old('carrera'))
                            ->required()
                            ->options([
                                'sistemas' => 'Ing de Sistemas',
                                'enfermeria' => 'Enfermeria',
                                'telecom' => 'Ing en Telecomunicaciones',
                                'civil' => 'Ing Civil',
                                'turismo' => 'Turismo'
                            ]),
                        Forms\Components\TextInput::make('direccion')
                            ->label('Dirección')
                            ->default(old('direccion'))
                            ->required(),
                        Forms\Components\TextInput::make('telefono')
                            ->rules(['numeric', 'digits:11'])
                            ->default(old('telefono'))
                            ->label('Número de teléfono')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label('Correo electrónico')
                            ->default(old('email'))
                            ->required()
                            ->email(),
                        Forms\Components\Select::make('pais')
                            ->label('País de origen / Nacionlidad')
                            ->default(old('pais'))
                            ->required()
                            ->options($this->paises->pluck('name', 'name')),
                        Forms\Components\DatePicker::make('fecha_egreso')
                            ->label('Fecha de Egreso')
                            ->default(old('fecha_egreso'))
                            ->required()
                            ->displayFormat('d/m/Y')
                            ->columnSpan(2),
                        Forms\Components\Hidden::make('identificador')->default(session('code')),

                    ]),
                Wizard\Step::make('Trámites a solicitar')
                    ->description('Nacional o Internacional')
                    ->icon('heroicon-o-qrcode')
                    ->schema([
                        Forms\Components\Toggle::make('encomienda')
                            ->label('¿Desea agregar el arencel de encomienda?')
                            ->default(false),
                        Forms\Components\Repeater::make('motivos')
                            ->label('Documentos a solicitar')
                            ->schema([
                                Forms\Components\Select::make('tipo')
                                    ->label('Modalidad del Trámite')
                                    ->required()
                                    ->options([
                                        'nacional' => 'Nacional',
                                        'internacional' => 'Internacional',
                    
                                    ])
                                    ->reactive()
                                    ->afterStateUpdated(fn (callable $set) => $set('motivo' , null)),
                                    Forms\Components\Select::make('motivo')
                                        ->label('Documento')
                                        ->required()
                                        ->options(function(callable $get){
                                            $motivo = Motivo::where('tipo', $get('tipo'))->get();

                                            return $motivo->pluck('nombre', 'nombre');


                                        })
                                        ->reactive()
                                        ->afterStateUpdated(function (Closure $get , $set, $state) {
                                            $set('precio', Motivo::where('nombre', $state)->where('tipo' , $get('tipo'))->first()->precio);
                                            $set('id' , Motivo::where('nombre', $state)->where('tipo' , $get('tipo'))->first()->id);
                                        }),

                                    Forms\Components\Hidden::make('id'),
                                    
                                    Forms\Components\TextInput::make('cantidad')
                                        ->rules(['numeric', 'max:5'])
                                        ->label('Cantidad requerida')
                                        ->required(),
                                    Forms\Components\TextInput::make('precio')
                                        ->disabled()
                                        ->helperText('Precio expresado en Petros'),
                                    

                                
                        ])
                        ->columnSpan(2)
                        ->columns(2)
                        ->createItemButtonLabel('Añadir otro documento'),


                    ]),
            ])
            ->columns(2)
            ->submitAction(new HtmlString('<button type="submit" class="bg-primary-600 font-bold rounded px-4 py-1 text-white"> Proceder con el pago</button>')),

        ];
    }

    public function submit()
    {
        $motivosBD = Motivo::whereIn('id', collect($this->motivos)->pluck('id')->toArray())->get();
        $totalPetro = 0;
        foreach ($this->motivos as $key => $value) {
            $totalPetro += $motivosBD->where('id', $value['id'])->first()->precio * $value['cantidad'];
        }
    
        session(['tramite_temporal' => $this->form->getState()]);
        $Payment = new IpgBdvPaymentRequest();
        $Payment->idLetter= $this->tipo_cedula; //Letra de la cédula - V, E o P
        $Payment->idNumber= 16085405; //Número de cédula
        //TODO: BUSCAR VALOR PETRO VIA API OFICIAL;
        //TODO: BUSCAR VALOR PETRO VIA API OFICIAL;
        //TODO: BUSCAR VALOR PETRO VIA API OFICIAL;
        //TODO: BUSCAR VALOR PETRO VIA API OFICIAL;
        $Payment->amount= $totalPetro * 321.91 ;//TODO: BUSCAR VALOR PETRO VIA API OFICIAL; //Monto a cobrar, FLOAT
        $Payment->currency= 1; //Moneda del pago, 1 - Bolivar Fuerte, 2 - Dolar
        $Payment->reference= "{$this->tipo_cedula}{$this->cedula}-{$this->identificador}"; //Código de referecia o factura
        $Payment->title= "TRÁMITES NACIONALES E INTERNACIONALES PARA EGRESADOS"; //Título para el pago, Ej: Servicio de Cable
        $Payment->description= "Documentos tramitados " . ($this->encomienda ? 'con servicio de encomienda' : 'sin servicio de encomienda'); //Descripción del pago, Ej: Abono mes de marzo 2017
        $Payment->email= $this->email; //Mail para envio de token si corresponde
        $Payment->cellphone= "4122741219"; //telefono para envio de token si corresponde en otros bancos
        $Payment->urlToReturn= route('bdv.webhook'); //URL de retorno al finalizar el pago

        $PaymentProcess = new IpgBdv(config('bdv.user'), config('bdv.password'));

        $response = $PaymentProcess->createPayment($Payment);

        if ($response->success == true) // Se evalúa la respuesta
        {
            return redirect($response->urlPayment);
        }
        else
        {
            return $response->responseCode . " - " . $response->responseMessage;
        }
        
    }

    public function render(): View
    {
        return view('livewire.tramites.crear-tramite');
    }
}
