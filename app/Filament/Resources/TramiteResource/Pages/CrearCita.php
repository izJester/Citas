<?php

namespace App\Filament\Resources\TramiteResource\Pages;

use App\Filament\Resources\TramiteResource;
use App\Filament\Resources\CitaResource;
use Filament\Resources\Pages\Page;
use Filament\Forms;
use App\Models\Cita;
use App\Models\Tramite;
use Closure;

class CrearCita extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $cita;
    public $fecha;
    public $tramite;
    public $record;
    public $estatus;
    public $tramite_id;

    public function mount()
    {
        $this->tramite = Tramite::where('id', $this->record)->first();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Card::make()
                        ->schema([

                          Forms\Components\Select::make('estatus')
                                ->required()
                                ->reactive()
                                ->label('Estatus')
                                ->options([
                                    'Pendiente' => 'Pendiente',
                                    'Cancelada' => 'Cancelada',
                                    'Realizada' => 'Realizada',
                                ]),
                            Forms\Components\DatePicker::make('fecha')
                                ->label('Fecha de la cita')
                                ->hidden(fn(Closure $get) => $get('estatus') != 'Realizada'),
                            
                        ]),
        ];
    }


    public function submit()
    {
        Cita::create(array_merge((array) $this->form->getState(), ['tramite_id' => $this->tramite->id]));

        $this->notify('success', 'Cita creada');

        return redirect(CitaResource::getUrl('index'));
    }

    protected function afterSave(): void
    {
        
        
    }

    protected static string $resource = TramiteResource::class;

    protected static string $view = 'filament.resources.tramite-resource.pages.crear-cita';
}
