<?php

namespace Modules\RH\Filament\RH\Resources;

use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Modules\RH\Filament\RH\Resources\MpeResource\Pages\ListMpes;
use Modules\RH\Filament\RH\Resources\MpeResource\Pages\CreateMpe;
use Modules\RH\Filament\RH\Resources\MpeResource\Pages\EditMpe;
use Modules\RH\Filament\RH\Resources\MpeResource\Pages;
use Modules\RH\Filament\RH\Resources\MpeResource\RelationManagers;
use Modules\RH\Models\Mpe;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class MpeResource extends Resource
{
    protected static ?string $model = Mpe::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Marins';
    protected static ?string $navigationLabel= 'MPE';

    protected static ?string $modelLabel= 'Liste MPE';

    protected static ?string $pluralModelLabel= 'Liste MPE';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListMpes::route('/'),
            'create' => CreateMpe::route('/create'),
            'edit' => EditMpe::route('/{record}/edit'),
        ];
    }
}
