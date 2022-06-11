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
use Illuminate\Support\Facades\Mail;
use App\Mail\TramiteRegistradoConExito;

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
                    ->icon('heroicon-o-shopping-bag')
                    ->schema([
                        Forms\Components\TextInput::make('nombres')
                            ->label('Nombres')
                            ->default(old('nombres'))
                            ->required(),
                        Forms\Components\TextInput::make('apellidos')
                            ->label('Apellidos')
                            ->required(),
                        Forms\Components\Select::make('tipo_cedula')
                            ->label('Tipo de Cedula')
                            ->required()
                            ->options([
                                'V' => 'V',
                                'E' => 'E',
                                'R' => 'R',
                            ]),
                        Forms\Components\TextInput::make('cedula')
                            ->label('Cedula')
                            ->required(),
                        Forms\Components\Select::make('nucleo')
                            ->label('Nucleo')
                            ->required()
                            ->options([
                                'chuao' => 'Chuao',
                                'maracay' => 'Maracay',
                                'guaira' => 'La Guaira',
                                'teques' => 'Los Teques'
                            ]),
                        Forms\Components\Select::make('carrera')
                            ->label('Carrera')
                            ->required()
                            ->options([
                                'sistemas' => 'Ing de Sistemas',
                                'enfermeria' => 'Enfermeria',
                                'telecom' => 'Ing en Telecomunicaciones',
                                'civil' => 'Ing Civil',
                                'turismo' => 'Turismo'
                            ]),
                        Forms\Components\TextInput::make('direccion')
                            ->label('Direccion')
                            ->required(),
                        Forms\Components\TextInput::make('telefono')
                            ->label('Telefono')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->required()
                            ->email(),
                        Forms\Components\Select::make('pais')
                            ->label('Pais')
                            ->required()
                            ->options($this->paises->pluck('name', 'name')),
                        Forms\Components\DatePicker::make('fecha_egreso')
                            ->label('Fecha de Egreso')
                            ->required()
                            ->displayFormat('d/m/Y')
                            ->columnSpan(2),
                        Forms\Components\Hidden::make('identificador')->default(session('code')),

                    ]),
                Wizard\Step::make('Tipo de Tramite')
                    ->description('Nacional o Internacional')
                    ->icon('heroicon-o-shopping-bag')
                    ->schema([
                        Forms\Components\Toggle::make('encomienda')
                            ->label('Quieres agregar el arancel de encomienda?')
                            ->required()
                            ->default(false),
                        Forms\Components\Repeater::make('motivos')
                            ->schema([
                                Forms\Components\Select::make('tipo')
                                    ->label('Tipo de Tramite')
                                    ->required()
                                    ->options([
                                        'Nacional' => 'Nacional',
                                        'Internacional' => 'Internacional',
                    
                                    ]),
                                    Forms\Components\Select::make('motivo')
                                    ->label('Motivo')
                                    ->required()
                                    ->options([
                                        'Notas Certificadas' => 'Notas Certificadas',
                                        'Certificacion de Titulo' => 'Certificacion de Titulo',
                                        'Validacion de Servicio Comunitario' => 'Validacion de Servicio Comunitario',
                    
                                    ]),
                                    Forms\Components\TextInput::make('cantidad')
                                    ->label('Cantidad')
                                    ->required()
                                
                        ])->columnSpan(2)->columns(3),


                    ]),
            ])
            ->columns(2)
            ->submitAction(new HtmlString('<button type="submit" class="bg-primary-600 font-bold rounded px-4 py-1 text-white"> Proceder con el pago</button>')),

        ];
    }

    public function submit()
    {
        $tramite = Tramite::create($this->form->getState());
        Mail::to($this->email)->send(new TramiteRegistradoConExito($tramite->id));
        if (empty($tramite->stripe_id)) {
            $stripeCustomer = $tramite->createAsStripeCustomer();
        }

        return $tramite->checkout(['price_1KlitfCfO3YICm7hCUSDnlO6'] , [
            'success_url' => route('success'),
            'cancel_url' => URL::signedRoute('temporary.create'),
        ]);
    }

    public function render(): View
    {
        return view('livewire.tramites.crear-tramite');
    }
}
