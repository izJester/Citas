<?php

namespace App\Http\Livewire\Tramites;

use Closure;
use Filament\Forms;
use App\Models\Motivo;
use App\Classes\IpgBdv;
use App\Models\Tramite;
use Livewire\Component;
use Squire\Models\Country;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\URL;
use App\Classes\IpgBdvPaymentRequest;
use Filament\Forms\Components\Wizard;
use Filament\Notifications\Notification;



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
                            ->required()
                            ->columnSpan(['default' => 2 , 'md' => 1]),
                        Forms\Components\TextInput::make('apellidos')
                            ->label('Apellidos')
                            ->required()
                            ->columnSpan(['default' => 2 , 'md' => 1]),
                        Forms\Components\Select::make('tipo_cedula')
                            ->label('Tipo de documento de identidad')
                            ->required()
                            ->options([
                                'V' => 'Venezolano',
                                'E' => 'Extranjero',
                                'P' => 'Pasaporte',
                            ])
                            ->columnSpan(['default' => 2 , 'md' => 1]),
                        Forms\Components\TextInput::make('cedula')
                            ->label('Número de documento de identidad')
                            ->numeric()
                            ->required()
                            ->columnSpan(['default' => 2 , 'md' => 1]),
                        Forms\Components\Select::make('nucleo')
                            ->label('Núcleo')
                            ->required()
                            ->options([
                                'chuao' => 'Chuao',
                                'maracay' => 'Maracay',
                                'guaira' => 'La Guaira',
                                'teques' => 'Los Teques'
                            ])
                            ->columnSpan(['default' => 2 , 'md' => 1]),
                        Forms\Components\Select::make('carrera')
                            ->label('Carrera cursada')
                            ->required()
                            ->options([
                                'sistemas' => 'Ing de Sistemas',
                                'enfermeria' => 'Enfermeria',
                                'telecom' => 'Ing en Telecomunicaciones',
                                'civil' => 'Ing Civil',
                                'turismo' => 'Turismo'
                            ])
                            ->columnSpan(['default' => 2 , 'md' => 1]),
                        Forms\Components\TextInput::make('direccion')
                            ->label('Dirección')
                            ->required()
                            ->columnSpan(['default' => 2 , 'md' => 1]),
                        Forms\Components\TextInput::make('telefono')
                            ->rules(['numeric', 'digits:11'])
                            ->numeric()
                            ->label('Número de teléfono')
                            ->required()
                            ->columnSpan(['default' => 2 , 'md' => 1]),
                        Forms\Components\TextInput::make('email')
                            ->label('Correo electrónico')
                            ->required()
                            ->email()
                            ->columnSpan(['default' => 2 , 'md' => 1]),
                        Forms\Components\Select::make('pais')
                            ->label('País de origen / Nacionlidad')
                            ->required()
                            ->searchable()
                            ->options($this->paises->pluck('name', 'name'))
                            ->columnSpan(['default' => 2 , 'md' => 1]),
                        Forms\Components\DatePicker::make('fecha_egreso')
                            ->label('Fecha de Egreso')
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
                            ->collapsible()
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

    public function submit(): void
    {
        $motivosBD = Motivo::whereIn('id', collect($this->motivos)->pluck('id')->toArray())->get();
        $totalPetro = 0;
        foreach ($this->motivos as $key => $value) {
            $totalPetro += $motivosBD->where('id', $value['id'])->first()->precio * $value['cantidad'];
        }
    
        session(['tramite_temporal' => $this->form->getState()]);
        $Payment = new IpgBdvPaymentRequest();
        $Payment->idLetter= $this->tipo_cedula; //Letra de la cédula - V, E o P
        $Payment->idNumber= $this->cedula; //Número de cédula
        $Payment->amount= $totalPetro * 321.91 ;//TODO: BUSCAR VALOR PETRO VIA API OFICIAL; //Monto a cobrar, FLOAT
        $Payment->currency= 1; //Moneda del pago, 1 - Bolivar Fuerte, 2 - Dolar
        $Payment->reference= "{$this->tipo_cedula}{$this->cedula}-{$this->identificador}"; //Código de referecia o factura
        $Payment->title= "TRÁMITES NACIONALES E INTERNACIONALES PARA EGRESADOS"; //Título para el pago, Ej: Servicio de Cable
        $Payment->description= "Documentos tramitados " . ($this->encomienda ? 'con servicio de encomienda' : 'sin servicio de encomienda') . ' - UNEFA CHUAO'; //Descripción del pago, Ej: Abono mes de marzo 2017
        $Payment->email= $this->email; //Mail para envio de token si corresponde
        $Payment->cellphone= "4122741219"; //telefono para envio de token si corresponde en otros bancos
        $Payment->urlToReturn= route('bdv.webhook'); //URL de retorno al finalizar el pago

        $PaymentProcess = new IpgBdv(config('bdv.user'), config('bdv.password'));

        $response = $PaymentProcess->createPayment($Payment);

        if ($response->success == true) // Se evalúa la respuesta
        {
            redirect($response->urlPayment);
        }
        else
        {
            Log::emergency("Falla de comunicación con BDV", ['bdv_response' => $response]);
            $response->responseCode . " - " . $response->responseMessage;

            Notification::make() 
            ->title('Hubo un error')
            ->danger()
            ->seconds(5) 
            ->body('Hubo un error al intentar conectar con la pasarela de pago, intente mas tarde')
            ->send(); 
        }
        
    }

    public function render(): View
    {
        return view('livewire.tramites.crear-tramite');
    }
}
