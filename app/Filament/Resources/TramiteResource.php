<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TramiteResource\Pages;
use App\Filament\Resources\CitaResource;
use App\Filament\Resources\TramiteResource\RelationManagers;
use App\Models\Tramite;
use App\Models\Cita;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Mail;
use App\Mail\CrearCitaTramite;

use Illuminate\Database\Eloquent\Collection;
use Closure;

class TramiteResource extends Resource
{
    protected static ?string $model = Tramite::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Certificacion';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('identificador')
                ->required(),
                Forms\Components\TextInput::make('nombres')
                    ->maxLength(255),
                Forms\Components\TextInput::make('apellidos')
                    ->maxLength(255),
                Forms\Components\TextInput::make('tipo_cedula')
                    ->maxLength(255),
                Forms\Components\TextInput::make('cedula')
                    ->maxLength(255),
                Forms\Components\TextInput::make('direccion')
                    ->maxLength(255),
                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('fecha_egreso'),
                Forms\Components\Textarea::make('motivos'),
                Forms\Components\Toggle::make('encomienda'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table 
            ->columns([
                Tables\Columns\TextColumn::make('nombres')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('apellidos')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('telefono'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
            
                Tables\Columns\BooleanColumn::make('encomienda'),
            ])
            ->filters([
                //
            ])
            
            
            ->bulkActions([
                        Tables\Actions\BulkAction::make('delete')
                            ->label('Eliminar')
                            ->action(fn (Collection $records) => $records->each->delete())
                            ->deselectRecordsAfterCompletion()
                            ->requiresConfirmation()
                            ->color('danger')
                            ->icon('heroicon-o-trash')
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
            'view' => Pages\VerTramite::route('/{record}'),
            //'edit' => Pages\EditTramite::route('/{record}/edit'),
            'create_cita' => Pages\CrearCita::route('/crear-cita/{record}'),
        ];
    }
}
