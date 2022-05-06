<?php

namespace App\Filament\Resources\TramiteResource\Pages;

use App\Filament\Resources\TramiteResource;
use Filament\Resources\Pages\Page;
use Filament\Forms;
use App\Models\Cita;

class Citas extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Cita $cita;

    public function mount()
    {
        $this->cita = new Cita();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Card::make()
                        ->schema([
                            Forms\Components\Grid::make()
                                ->schema([
                                    Forms\Components\TextInput::make('cita.cedula')
                                    ->required()
                                    ->label('Cedula')
                                    ->placeholder('Ejemplo: V12345678')
                                    ->columnSpan(6),
                                    Forms\Components\DatePicker::make('cita.fecha')
                                    ->required()
                                    ->label('Fecha de la cita')
                                    ->columnSpan(6),
                                ])->columns(12),
                        ]),
        ];
    }

    public function submit()
    {
        $this->cita->save();
        $this->notify('success', 'Cita creada');
    }

    
    protected static string $resource = TramiteResource::class;

    protected static string $view = 'filament.resources.tramite-resource.pages.citas';
}
