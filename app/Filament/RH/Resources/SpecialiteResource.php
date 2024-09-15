<?php

namespace Modules\RH\Filament\RH\Resources;

use Modules\RH\Filament\RH\Resources\SpecialiteResource\Pages;
use Modules\RH\Filament\RH\Resources\SpecialiteResource\RelationManagers;
use Modules\RH\Models\Specialite;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpecialiteResource extends Resource
{
    protected static ?string $model = Specialite::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('libelle_court')
                    ->required()
                    ->maxLength(10)
                    ->default(''),
                Forms\Components\TextInput::make('libelle_long')
                    ->required()
                    ->maxLength(100)
                    ->default(''),
                Forms\Components\TextInput::make('ordre')
                    ->required()
                    ->numeric(),
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
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('libelle_court')
                    ->searchable(),
                Tables\Columns\TextColumn::make('libelle_long')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ordre')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSpecialites::route('/'),
            'create' => Pages\CreateSpecialite::route('/create'),
            'edit' => Pages\EditSpecialite::route('/{record}/edit'),
        ];
    }
}
