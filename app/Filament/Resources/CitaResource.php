<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CitaResource\Pages;
use App\Filament\Resources\CitaResource\RelationManagers;
use App\Models\Cita;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class CitaResource extends Resource
{
    protected static ?string $model = Cita::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Certificacion';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\DatePicker::make('fecha')
                            ->label('Fecha de la cita'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tramite.nombres')
                    ->searchable()
                    ->label('Nombres'),
                Tables\Columns\TextColumn::make('tramite.apellidos')
                    ->searchable()
                    ->label('Apellidos'),
                Tables\Columns\TextColumn::make('tramite.carrera')
                    ->searchable()
                    ->label('Carrera'),
                Tables\Columns\TextColumn::make('fecha')
                    ->date()
                    ,
            ])
            ->filters([
                Tables\Filters\Filter::make('fecha')
                    ->form([
                        Forms\Components\DatePicker::make('fecha'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['fecha'],
                                fn (Builder $query, $date): Builder => $query->whereDate('fecha', '=', $date),
                            );
                    })
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
            'index' => Pages\ListCitas::route('/'),
            //'create' => Pages\CreateCita::route('/create'),
            'edit' => Pages\EditCita::route('/{record}/edit'),
        ];
    }
}
