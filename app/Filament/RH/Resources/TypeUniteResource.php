<?php

namespace Modules\RH\Filament\RH\Resources;

use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Modules\RH\Filament\RH\Resources\TypeUniteResource\Pages\ListTypeUnites;
use Modules\RH\Filament\RH\Resources\TypeUniteResource\Pages\CreateTypeUnite;
use Modules\RH\Filament\RH\Resources\TypeUniteResource\Pages\EditTypeUnite;
use Modules\RH\Filament\RH\Resources\TypeUniteResource\Pages;
use Modules\RH\Filament\RH\Resources\TypeUniteResource\RelationManagers;
use Modules\RH\Models\TypeUnite;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;


class TypeUniteResource extends Resource
{
    protected static ?string $model = TypeUnite::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Gestion';
    protected static ?string $navigationLabel = "Types d'unités";

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('libelle_court')
                    ->required()
                    ->maxLength(10)
                    ->default('')
                    ->label('Libellé court'),
                TextInput::make('libelle_long')
                    ->required()
                    ->maxLength(100)
                    ->default('')
                    ->label('Libellé long'),
                // TextInput::make('ordre')
                //     ->required()
                //     ->numeric(),
                // Textarea::make('data')
                //     ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('libelle_court')
                    ->searchable()
                    ->label('Libellé court'),
                TextColumn::make('libelle_long')
                    ->searchable()
                    ->label('Libellé long'),
                // TextColumn::make('ordre')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->iconButton()
                    ->icon('heroicon-m-pencil-square')
                    ->extraAttributes([
                        'title' => 'Modifier',
                        'class' => 'btn-modif',
                        ]),
                DeleteAction::make()
                    ->iconButton()
                    ->icon('heroicon-m-trash')
                    ->extraAttributes([
                        'title' => 'Supprimer',
                        'class' => 'btn-suppr',
                        ]),
            ])
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ])
            ;
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
            'index' => ListTypeUnites::route('/'),
            'create' => CreateTypeUnite::route('/create'),
            'edit' => EditTypeUnite::route('/{record}/edit'),
        ];
    }
}
