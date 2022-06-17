<?php

namespace App\Filament\Resources\TramiteResource\Pages;

use App\Filament\Resources\TramiteResource;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\ViewRecord;
use App\Models\Tramite;

class VerTramite extends Page
{
    public $record;
    public $motivos;

    public function mount()
    {
        $this->record = Tramite::where('id' , $this->record)->with('cita')->first();
    }

    protected static string $resource = TramiteResource::class;

    protected static string $view = 'filament.resources.tramite-resource.pages.view-tramite';
}
