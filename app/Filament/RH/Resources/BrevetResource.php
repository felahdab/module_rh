<?php

namespace Modules\RH\Filament\RH\Resources;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Modules\RH\Filament\RH\Resources\BrevetResource\Pages\ListBrevets;
use Modules\RH\Filament\RH\Resources\BrevetResource\Pages\CreateBrevet;
use Modules\RH\Filament\RH\Resources\BrevetResource\Pages\EditBrevet;
use Modules\RH\Filament\RH\Resources\BrevetResource\Pages;
use Modules\RH\Filament\RH\Resources\BrevetResource\RelationManagers;
use Modules\RH\Models\Brevet;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class BrevetResource extends Resource
{
    protected static ?string $model = Brevet::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Gestion';

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
                TextInput::make('ordre')
                    ->required()
                    ->numeric()
                    ->label('Ordre'),
                // Forms\Components\Textarea::make('data')
                //     ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('libelle_court')
                    ->label('Libellé court')
                    ->searchable(),
                TextColumn::make('libelle_long')
                    ->label('Libellé long')
                    ->searchable(),
                TextColumn::make('ordre')
                    ->numeric()
                    ->sortable()
                    ->label('Ordre'),
                TextColumn::make('marins_count')
                    ->label('Nb Marins')
                    ->counts('marins')
                    ->sortable()
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('ordre', 'asc')
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
                        ])
                    ->before(function (DeleteAction $action, Brevet $record) {
                        $ordre=$record->ordre;
                        $list_brevets=Brevet::all();
                        foreach($list_brevets as $brevet){
                            if ($brevet->ordre >= $ordre){
                                $brevet->ordre --;
                                $brevet->save();
                            }
                        }
                    }),
            ])
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ])
            // ])
            ;
    }

    // protected function getDefaultTableSortColumn(): ?string
    // {
    //     return 'ordre';
    // }
    // protected function getDefaultTableSortDirection(): ?string
    // {
    //     return 'asc';
    // }
    // protected function shouldPersistTableSortInSession(): bool
    // {
    //     return true;
    // }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBrevets::route('/'),
            'create' => CreateBrevet::route('/create'),
            'edit' => EditBrevet::route('/{record}/edit'),
        ];
    }

    // protected function getActions(): array
    // {
    //     // return [
    //         dd('toto');
    //     Actions\DeleteAction::make()

    //     ->before(function (DeleteAction $action) {
    //         
    //             dd($action);
    //         
    //     })
    // // ]
    // ;
    // }

    // protected function handleRecordDelation(array $data): Model
    // {
    //     dd('toto');
    //     $ordre=$data['ordre'];
    //     $list_brevets=Brevet::all();
    //     foreach($list_brevets as $brevet){
    //         if ($brevet->ordre >= $ordre){
    //             $brevet->ordre --;
    //             $brevet->save();
    //         }
    //     }
    //     return static::getModel()::delete($data);
    // }


}
