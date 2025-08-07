<?php

namespace Modules\RH\Filament\RH\Resources;

use Modules\RH\Filament\RH\Resources\BrevetResource\Pages;
use Modules\RH\Filament\RH\Resources\BrevetResource\RelationManagers;
use Modules\RH\Models\Brevet;
use Filament\Forms;
use Filament\Forms\Form;
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Gestion';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('libelle_court')
                    ->required()
                    ->maxLength(10)
                    ->default('')
                    ->label('Libellé court'),
                Forms\Components\TextInput::make('libelle_long')
                    ->required()
                    ->maxLength(100)
                    ->default('')
                    ->label('Libellé long'),
                Forms\Components\TextInput::make('ordre')
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
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('libelle_court')
                    ->label('Libellé court')
                    ->searchable(),
                Tables\Columns\TextColumn::make('libelle_long')
                    ->label('Libellé long')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ordre')
                    ->numeric()
                    ->sortable()
                    ->label('Ordre'),
                Tables\Columns\TextColumn::make('marins_count')
                    ->label('Nb Marins')
                    ->counts('marins')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('ordre', 'asc')
            ->filters([
                //
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
                        ])
                    ->before(function (Tables\Actions\DeleteAction $action, Brevet $record) {
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
            'index' => Pages\ListBrevets::route('/'),
            'create' => Pages\CreateBrevet::route('/create'),
            'edit' => Pages\EditBrevet::route('/{record}/edit'),
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
