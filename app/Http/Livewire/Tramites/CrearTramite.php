<?php

namespace App\Http\Livewire\Tramites;

use Filament\Forms;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Filament\Forms\Components\Wizard;
use App\Models\Tramite;
use Squire\Models\Country;
use Illuminate\Support\HtmlString;

class CrearTramite extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Tramite $tramite;
    public $paises;
 
    public function mount(): void 
    {

        $this->tramite = new Tramite;
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
                        Forms\Components\TextInput::make('tramite.nombres')
                            ->label('Nombres')
                            ->required(),
                        Forms\Components\TextInput::make('tramite.apellidos')
                            ->label('Apellidos')
                            ->required(),
                        Forms\Components\Select::make('tramite.tipo_cedula')
                            ->label('Tipo de Cedula')
                            ->required()
                            ->options([
                                'V' => 'V',
                                'E' => 'E',
                                'R' => 'R',
                            ]),
                        Forms\Components\TextInput::make('tramite.cedula')
                            ->label('Cedula')
                            ->required(),
                        Forms\Components\TextInput::make('tramite.direccion')
                            ->label('Direccion')
                            ->required(),
                        Forms\Components\TextInput::make('tramite.telefono')
                            ->label('Telefono')
                            ->required(),
                        Forms\Components\TextInput::make('tramite.email')
                            ->label('Email')
                            ->required()
                            ->email(),
                        Forms\Components\Select::make('tramite.pais')
                            ->label('Pais')
                            ->required()
                            ->options($this->paises->pluck('name', 'id')),
                        Forms\Components\DateTimePicker::make('tramite.fecha_nacimiento')
                            ->label('Fecha de Nacimiento')
                            ->required()
                            ->displayFormat('d/m/Y')
                            ->columnSpan(2),

                    ]),
                Wizard\Step::make('Tipo de Tramite')
                    ->description('Nacional o Internacional')
                    ->icon('heroicon-o-shopping-bag')
                    ->schema([
                        Forms\Components\Repeater::make('Tramites')
                            ->schema([
                                Forms\Components\Select::make('tramite.tipo_tramite')
                                    ->label('Tipo de Tramite')
                                    ->required()
                                    ->options([
                                        'Nacional' => 'Nacional',
                                        'Internacional' => 'Internacional',
                    
                                    ]),
                                Forms\Components\TextInput::make('tramite.pais_origen')
                                
                        ])->columnSpan(2)->columns(2)
                    ]),
                Wizard\Step::make('Pagar')
                    ->description('Pasarela de Pago')
                    ->icon('heroicon-o-shopping-bag')
                    ->schema([
                        Forms\Components\TextInput::make('name'),
                        Forms\Components\TextInput::make('email')
                    ]),
            ])
            ->columns(2)
            ->submitAction(new HtmlString('<button type="submit" class="bg-blue-600 font-bold rounded px-4 py-1 text-white">Enviar</button>')),

        ];
    }

    public function submit()
    {
        $this->tramite->save();
    }

    public function render(): View
    {
        return view('livewire.tramites.crear-tramite');
    }
}
