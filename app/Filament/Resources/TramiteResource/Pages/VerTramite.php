<?php

namespace App\Filament\Resources\TramiteResource\Pages;

use App\Filament\Resources\TramiteResource;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\ViewRecord;
use App\Models\Tramite;

class VerTramite extends Page
{

    public Tramite $record;

    protected static string $resource = TramiteResource::class;

    protected static string $view = 'filament.resources.tramite-resource.pages.view-tramite';
}
