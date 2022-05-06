<?php

namespace App\Filament\Resources\CorreoResource\Pages;

use App\Filament\Resources\CorreoResource;
use Filament\Resources\Pages\Page;
use Filament\Forms;
use App\Mail\InfoAdicional;
use Illuminate\Support\Facades\Mail;

class Correos extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $email = '';
    public $content = '';

    public function mount(): void
    {
        $this->form->fill();
    }
    
    protected function getFormSchema(): array 
    {
        return [

            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\Card::make()
                        ->schema([
                            Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->label('Correo'),
                            Forms\Components\RichEditor::make('content')
                            ->required()
                            ->label('Contenido'),
                        ])->columnSpan(12),
                  
                    
                ])->columns(12)
        ];
    } 

    public function submit(): void 
    {
        Mail::to($this->email)->send(new InfoAdicional($this->content));
        $this->reset('email');
        $this->reset('content');
        $this->notify('success', 'Enviado');
    } 

    protected static string $resource = CorreoResource::class;

    protected static string $view = 'filament.resources.correo-resource.pages.correos';
}
