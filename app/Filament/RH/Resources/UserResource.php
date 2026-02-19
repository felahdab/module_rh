<?php

namespace Modules\RH\Filament\RH\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Modules\RH\Filament\RH\Resources\UserResource\Pages;
use Modules\RH\Filament\RH\Resources\UserResource\RelationManagers;
use Modules\RH\Filament\RH\Resources\UserResource\Actions;
use Modules\RH\Models\User;
use Modules\RH\Models\Unite;
use Modules\RH\Models\UserUnite;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = "Utilisateurs";

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
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('display_name')
                    ->required()
                    ->maxLength(200)
                    ->default(''),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description("Cette table affiche la liste des utilisateurs et permet notamment de savoir si les utilisateurs sont associés à une unité.
                La visibilité de certaines informations ou fonctionnalités est conditionnée par le fait que l'utilisateur est assigné à une unité ou pas.
                Les règles précises dépendent de chaque module. Pour pouvoir attribuer une unité, vous devez disposer de l'autorisation 
                rh::attribuer_une_unite_a_un_utilisateur")
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prenom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('display_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unite')
                    ->label("Unité")
                    ->formatStateUsing(fn($record) => $record->getUnite()?->libelle_long ?? "N/A")
                    ->searchable(),
                Tables\Columns\IconColumn::make('admin')
                    ->boolean(),
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
                SelectFilter::make('unite')
                    ->label("Unité")
                    ->options(Unite::orderBy('libelle_long')->pluck('libelle_long', 'id'))
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['value'],
                                fn (Builder $query, $unite): Builder => $query->deUnite(Unite::find($unite))
                            );
                    })
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                Actions\AttribuerUneUniteAUnUtilisateurAction::make("attribuer_une_unite"),
                Actions\RetirerUneUniteAUnUtilisateurAction::make("retirer_une_unite"),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
