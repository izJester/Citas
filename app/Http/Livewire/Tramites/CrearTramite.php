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
                            ->default(old('apellidos'))
                            ->required(),
                        Forms\Components\Select::make('tipo_cedula')
                            ->label('Tipo de Cedula')
                            ->default(old('tipo_cedula'))
                            ->required()
                            ->options([
                                'V' => 'V',
                                'E' => 'E',
                                'R' => 'R',
                            ]),
                        Forms\Components\TextInput::make('cedula')
                            ->label('Cedula')
                            ->default(old('cedula'))
                            ->required(),
                        Forms\Components\Select::make('nucleo')
                            ->label('Nucleo')
                            ->default(old('nucleo'))
                            ->required()
                            ->options([
                                'chuao' => 'Chuao',
                                'maracay' => 'Maracay',
                                'guaira' => 'La Guaira',
                                'teques' => 'Los Teques'
                            ]),
                        Forms\Components\Select::make('carrera')
                            ->label('Carrera')
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
                            ->label('Direccion')
                            ->default(old('direccion'))
                            ->required(),
                        Forms\Components\TextInput::make('telefono')
                            ->rules(['numeric', 'digits:11'])
                            ->default(old('telefono'))
                            ->label('Telefono')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->default(old('email'))
                            ->required()
                            ->email(),
                        Forms\Components\Select::make('pais')
                            ->label('Pais')
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
                Wizard\Step::make('Tipo de Tramite')
                    ->description('Nacional o Internacional')
                    ->icon('heroicon-o-shopping-bag')
                    ->schema([
                        Forms\Components\Toggle::make('encomienda')
                            ->label('Quieres agregar el arancel de encomienda?')
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
                                    ->rules(['numeric', 'max:5'])
                                    ->label('Cantidad')
                                    ->required()
                                
                        ])
                        ->columnSpan(2)
                        ->columns(3)
                        ->createItemButtonLabel('Añadir otro motivo'),


                    ]),
            ])
            ->columns(2)
            ->submitAction(new HtmlString('<button type="submit" class="bg-primary-600 font-bold rounded px-4 py-1 text-white"> Proceder con el pago</button>')),

        ];
    }

    public function submit()
    {
        $tramite = Tramite::create($this->form->getState());
        if (empty($tramite->stripe_id)) {
            $tramite->createAsStripeCustomer();
        }

        return $tramite->checkout(['price_1KlitfCfO3YICm7hCUSDnlO6'] , [
            'success_url' => route('success') . '?tramite=' . $tramite->id,
            'cancel_url' => route('fail') . '?tramite=' . $tramite->id,
        ]);
    }

    public function render(): View
    {
        return view('livewire.tramites.crear-tramite');
    }
}
