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
                Forms\Components\Select::make('grade_id')
                    ->relationship(name: 'grade', titleAttribute: 'libelle_long'),
                Forms\Components\Select::make('specialite_id')
                    ->relationship(name: 'specialite', titleAttribute: 'libelle_court'),
                Forms\Components\Select::make('brevet_id')
                    ->relationship(name: 'brevet', titleAttribute: 'libelle_long'),
                Forms\Components\Select::make('unite_id')
                    ->relationship(name: 'unite', titleAttribute: 'libelle_long'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prenom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matricule')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('nid')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_embarq')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_debarq')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('grade.libelle_court')
                    ->searchable(),
                Tables\Columns\TextColumn::make('specialite.libelle_court')
                    ->searchable(),
                Tables\Columns\TextColumn::make('brevet.libelle_court')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unite.libelle_court')
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
                    ->url(
                        function($record)
                        {
                            return Pages\AssociateMarin::getUrl(["record" => $record]);
                        }
                    ),
                Tables\Actions\Action::make('verifier-avec-serveur-distant')
                    ->action(function(Marin $record)
                    {
                        ConfirmMarinUuidJob::dispatch($record->uuid);
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
            'associate' => Pages\AssociateMarin::route('/{record}/associate'),
        ];
    }
}
