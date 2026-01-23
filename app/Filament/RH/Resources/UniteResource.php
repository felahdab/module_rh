<?php

namespace Modules\RH\Filament\RH\Resources;

use Modules\RH\Filament\RH\Resources\UniteResource\Pages;
use Modules\RH\Filament\RH\Resources\UniteResource\RelationManagers;
use Modules\RH\Models\Unite;
use Modules\RH\Models\TypeUnite;
use Modules\RH\Models\LieuUnite;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;


class UniteResource extends Resource
{
    protected static ?string $model = Unite::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Gestion';
    protected static ?string $navigationLabel = 'Unités';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('libelle_court')
                    ->required()
                    ->maxLength(100)
                    ->default('')
                    ->label('Libellé court'),
                TextInput::make('libelle_long')
                    ->required()
                    ->maxLength(150)
                    ->default('')
                    ->label('Libellé long'),
                // Select::make('id_mere')
                //     ->label('Unité de rattachement')
                //     ->relationship(name: 'parent', titleAttribute: 'libelle_long')
                //     ->required(),    
                Select::make('lieu_unite_id')
                ->relationship(name: 'lieuUnite', titleAttribute: 'libelle_long')
                ->label("Lieu d'unité"),   
                // Liaison entre Unite et Type Unite
                Select::make('type_unite_id')
                    ->relationship(name: 'typeUnite', titleAttribute: 'libelle_long')
                    ->label("Type d'unité"),   
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
            ->defaultSort('libelle_court','asc')
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('parent.libelle_court')
                //     ->label('Unité rattach.')
                //     ->sortable()
                //     ->searchable(),         
                TextColumn::make('libelle_court')
                    ->searchable()
                    ->sortable()
                    ->label('Libellé court'),
                TextColumn::make('libelle_long')
                    ->searchable()
                    ->sortable()
                    ->label('Libellé long'),
                TextColumn::make('marins_count')
                    ->label('Nb Marins')
                    ->counts('marins')
                    ->badge(),        
                TextColumn::make('typeUnite.libelle_court')
                    ->searchable()
                    ->label('Type unité')
                    //->toggleable(isToggledHiddenByDefault: true)
                    ,
                TextColumn::make('lieuUnite.libelle_court')
                    ->searchable()
                    ->label('Lieu') ,
                // TextColumn::make('ordre')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                
            ])
            ->filters([
                // SelectFilter::make('id_mere')
                //     ->label('Unité rattach.')
                //     ->options(Unite::query()->orderBy('libelle_court','asc')->pluck('libelle_court', 'id')),
                SelectFilter::make('lieu_unite_id')
                ->label('Lieu unité')
                ->options(LieuUnite::query()->orderBy('libelle_court','asc')->pluck('libelle_court', 'id')),
                SelectFilter::make('type_unite_id')
                    ->label('Type unité')
                    ->options(TypeUnite::query()->orderBy('libelle_court','asc')->pluck('libelle_court', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->icon('heroicon-m-pencil-square')
                    ->extraAttributes([
                        'title' => 'Modifier',
                        'class' => 'btn-modif',
                        ]),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListUnites::route('/'),
            'create' => Pages\CreateUnite::route('/create'),
            'edit' => Pages\EditUnite::route('/{record}/edit'),
        ];
    }
}



