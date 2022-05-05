<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TramiteResource\Pages;
use App\Filament\Resources\TramiteResource\RelationManagers;
use App\Models\Tramite;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TramiteResource extends Resource
{
    protected static ?string $model = Tramite::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
            'index' => Pages\ListTramites::route('/'),
            'create' => Pages\CreateTramite::route('/create'),
            'edit' => Pages\EditTramite::route('/{record}/edit'),
        ];
    }
}
