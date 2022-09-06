<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CorreoResource\Pages;
use App\Filament\Resources\CorreoResource\RelationManagers;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class CorreoResource extends Resource
{

    protected static ?string $navigationIcon = 'heroicon-o-mail';
    protected static ?string $navigationGroup = 'Certificacion';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\Correos::route('/'),
        ];
    }
}
