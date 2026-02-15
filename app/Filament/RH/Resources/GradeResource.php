<?php

namespace Modules\RH\Filament\RH\Resources;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Modules\RH\Filament\RH\Resources\GradeResource\Pages\ListGrades;
use Modules\RH\Filament\RH\Resources\GradeResource\Pages\CreateGrade;
use Modules\RH\Filament\RH\Resources\GradeResource\Pages\EditGrade;
use Modules\RH\Filament\RH\Resources\GradeResource\Pages;
use Modules\RH\Filament\RH\Resources\GradeResource\RelationManagers;
use Modules\RH\Models\Grade;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Gestion';
    protected static ?string $navigationLabel = 'Grades';

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
            ->defaultSort('ordre','asc')
            ->columns([
                TextColumn::make('libelle_court')
                    ->searchable()
                    ->label('Libellé court'),
                TextColumn::make('libelle_long')
                    ->searchable()
                    ->label('Libellé long'),
                TextColumn::make('ordre')
                    ->label('Ordre')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('marins_count')
                    ->label('Nb marins')
                    ->counts('marins')
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
                    ->before(function (DeleteAction $action, Grade $record) {
                        $ordre=$record->ordre;
                        $list_grades=Grade::all();
                        foreach($list_grades as $grade){
                            if ($grade->ordre >= $ordre){
                                $grade->ordre --;
                                $grade->save();
                            }
                        }
                    }),
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
            'index' => ListGrades::route('/'),
            'create' => CreateGrade::route('/create'),
            'edit' => EditGrade::route('/{record}/edit'),
        ];
    }
}
