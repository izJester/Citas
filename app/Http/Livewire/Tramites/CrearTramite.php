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

    public function submit()
    {
        $motivosBD = Motivo::whereIn('id', collect($this->motivos)->pluck('id')->toArray())->get();
        $totalPetro = 0;
        foreach ($this->motivos as $key => $value) {
            $totalPetro += $motivosBD->where('id', $value['id'])->first()->precio * $value['cantidad'];
        }

        $tramite = Tramite::create($this->form->getState());
        if (empty($tramite->stripe_id)) {
            $tramite->createAsStripeCustomer();
        }

        return $tramite->checkoutCharge((int) ( $totalPetro * 33030), 'TRÁMITES NACIONALES E INTERNACIONALES PARA EGRESADOS', 1, [
            'success_url' => route('success' , ['tramite' => $tramite->id]),
            'cancel_url' => route('fail') . '?tramite=' . $tramite->id,
        ]);

    
        
    }

    public function render(): View
    {
        return view('livewire.tramites.crear-tramite');
    }
}
