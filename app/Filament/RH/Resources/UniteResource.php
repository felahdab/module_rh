<?php

namespace Modules\RH\Filament\RH\Resources;

use Modules\RH\Filament\RH\Resources\UniteResource\Pages;
use Modules\RH\Filament\RH\Resources\UniteResource\RelationManagers;
use Modules\RH\Models\Unite;
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

class UniteResource extends Resource
{
    protected static ?string $model = Unite::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Categories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('libelle_court')
                    ->required()
                    ->maxLength(10)
                    ->default(''),
                TextInput::make('libelle_long')
                    ->required()
                    ->maxLength(100)
                    ->default(''),

                // Liaison entre Unite et Type Unite
                Select::make('type_unite_id')
                    ->relationship(name: 'typeUnite', titleAttribute: 'libelle_long'),   
                // Categorie Mere Fille     
                Select::make('id_mere')
                    ->label('Categorie Mere')
                    ->relationship(name: 'parent', titleAttribute: 'libelle_long'),    
               
                TextInput::make('ordre')
                    ->required()
                    ->numeric(),
                Textarea::make('data')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('libelle_court')
                    ->searchable(),
                TextColumn::make('libelle_long')
                    ->searchable(),
                TextColumn::make('marins_count')
                    ->label('Nb Marins')
                    ->counts('marins')
                    ->sortable()
                    ->badge(),        
                TextColumn::make('typeUnite.libelle_court')
                    ->searchable(),  
                TextColumn::make('parent.libelle_court')
                    ->label('Categorie')
                    ->searchable(),         
                TextColumn::make('ordre')
                    ->numeric()
                    ->sortable(),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUnites::route('/'),
            'create' => Pages\CreateUnite::route('/create'),
            'edit' => Pages\EditUnite::route('/{record}/edit'),
        ];
    }
}



