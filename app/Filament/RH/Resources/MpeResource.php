<?php

namespace Modules\RH\Filament\RH\Resources;

use Modules\RH\Filament\RH\Resources\MpeResource\Pages;
use Modules\RH\Filament\RH\Resources\MpeResource\RelationManagers;
use Modules\RH\Models\Mpe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class MpeResource extends Resource
{
    protected static ?string $model = Mpe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Categories';

    protected static ?string $navigationLabel= 'Liste MPE';

    protected static ?string $modelLabel= 'Liste MPE';

    protected static ?string $pluralModelLabel= 'Liste MPE';

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
                TextColumn::make('marin.nom')
                    ->label('Nom marin')
                    ->getStateUsing(function ($record){
                            return $record->marin->nom.' '.$record->marin->prenom;
                    })
                    ->searchable(),
                
                TextColumn::make('unite.libelle_court')
                    ->searchable()
                    ->badge(),
                TextColumn::make('date_debut')
                ->label('Date de debut')
                ->sortable(),
                TextColumn::make('date_fin')
                ->label('Date de fin')
                ->sortable(),
                TextColumn::make('sans_date')
                ->label('Sans Date')
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
            'index' => Pages\ListMpes::route('/'),
            'create' => Pages\CreateMpe::route('/create'),
            'edit' => Pages\EditMpe::route('/{record}/edit'),
        ];
    }
}
