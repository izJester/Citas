<?php

namespace App\Filament\Resources\CorreoResource\Pages;

use App\Filament\Resources\CorreoResource;
use Filament\Resources\Pages\Page;
use Filament\Forms;

class Correos extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    
    protected function getFormSchema(): array 
    {
        return [
            Forms\Components\TextInput::make('Correo')->email(),
            Forms\Components\RichEditor::make('Informacion'),
            // ...
        ];
    } 

    protected static string $resource = CorreoResource::class;

    protected static string $view = 'filament.resources.correo-resource.pages.correos';
}
