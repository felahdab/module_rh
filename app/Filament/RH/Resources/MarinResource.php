<?php

namespace Modules\RH\Filament\RH\Resources;

use Modules\RH\Filament\RH\Resources\MarinResource\Pages;
use Modules\RH\Filament\RH\Resources\MarinResource\RelationManagers;
use Modules\RH\Models\Marin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Modules\RH\Jobs\ConfirmMarinUuidJob;

class MarinResource extends Resource
{
    protected static ?string $model = Marin::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('prenom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('matricule')
                    ->maxLength(20)
                    ->default(''),
                Forms\Components\TextInput::make('nid')
                    ->maxLength(15)
                    ->default(''),
                Forms\Components\DatePicker::make('date_embarq'),
                Forms\Components\DatePicker::make('date_debarq'),
                Forms\Components\TextInput::make('grade_id')
                    ->maxLength(36),
                Forms\Components\TextInput::make('specialite_id')
                    ->maxLength(36),
                Forms\Components\TextInput::make('brevet_id')
                    ->maxLength(36),
                Forms\Components\TextInput::make('secteur_id')
                    ->maxLength(36),
                Forms\Components\TextInput::make('unite_id')
                    ->maxLength(36),
                Forms\Components\Textarea::make('data')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prenom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matricule')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nid')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_embarq')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_debarq')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('grade_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('specialite_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('brevet_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('secteur_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unite_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('associer-a-un-utilisateur')
                    ->requiresConfirmation()
                    ->action(function()
                    {
                        ddd("TODO: doit demander a selectionner un utilisqteur puis inscrire dans record->data->rh->local_user_id le id du user designe");
                    }),
                Tables\Actions\Action::make('verifier-avec-serveur-distant')
                    ->action(function(Marin $record)
                    {
                        ConfirmMarinUuidJob::dispatch($record->id);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListMarins::route('/'),
            'create' => Pages\CreateMarin::route('/create'),
            'edit' => Pages\EditMarin::route('/{record}/edit'),
        ];
    }
}
