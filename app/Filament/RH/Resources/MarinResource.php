<?php

namespace Modules\RH\Filament\RH\Resources;

use Modules\RH\Filament\RH\Resources\MarinResource\Pages;
use Modules\RH\Filament\RH\Resources\MarinResource\RelationManagers;
use Modules\RH\Models\Marin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;



use Modules\RH\Jobs\ConfirmMarinUuidJob;

class MarinResource extends Resource
{
    protected static ?string $model = Marin::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    // Pour modifier slug (doc dans ressources)
    //protected static ?string $slug = 'toto';

    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nom')
                    ->required()
                    ->autofocus()
                    ->maxLength(255),
                TextInput::make('prenom')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->unique(
                        table: 'rh_marins',
                        column: 'email',
                        ignoreRecord : true
                    )
                    ->required(),
                TextInput::make('matricule')
                    ->maxLength(20)
                    ->default(''),
                TextInput::make('nid')
                    ->maxLength(15)
                    ->default(''),
                DatePicker::make('date_embarq'),
                DatePicker::make('date_debarq'),
                Select::make('grade_id')
                    ->relationship(name: 'grade', titleAttribute: 'libelle_long'),
                Select::make('specialite_id')
                    ->relationship(name: 'specialite', titleAttribute: 'libelle_court'),
                Select::make('brevet_id')
                    ->relationship(name: 'brevet', titleAttribute: 'libelle_long'),
                Select::make('unite_id')
                    ->relationship(name: 'unite', titleAttribute: 'libelle_long'),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('ID')
                    ->searchable(),
                TextColumn::make('nom')
                    ->searchable(),
                TextColumn::make('prenom')
                    ->searchable(),
                TextColumn::make('matricule')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('nid')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('date_embarq')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date()
                    ->sortable(),
                TextColumn::make('date_debarq')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date()
                    ->sortable(),
                TextColumn::make('grade.libelle_court')
                    ->searchable()
                    ->badge(),
                TextColumn::make('specialite.libelle_court')
                    ->searchable()
                    ->badge(),
                TextColumn::make('brevet.libelle_court')
                    ->searchable()
                    ->badge(),
                TextColumn::make('unite.libelle_court')
                    ->searchable()
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user.nom')
                    ->label('Utilisateur')
                    ->sortable()
                    ->searchable()
                    ->url(fn (Marin $record)=> $record->user  ? route ('filament.Skeletor.resources.users.edit', $record->user->id): null)  
                    //->visible(fn (?Marin $record)=> $record && $record->user !== null),    
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('associer-a-un-utilisateur')
                    ->url(
                        function($record)
                        {
                            return Pages\AssociateMarin::getUrl(["record" => $record]);
                        }
                    ),
                Tables\Actions\Action::make('verifier-avec-serveur-distant')
                    ->action(function(Marin $record)
                    {
                        ConfirmMarinUuidJob::dispatch($record->uuid);
                    }),
               
                // Bouton pour creer un user 
                Tables\Actions\Action::make('createUser')
                    ->label('Créer Utilisateur')
                    //->label('')
                    //->icon($icon = 'heroicon-o-user-add')
                    ->action(function (Marin $record) {
                        $user = $record->createUser();
                        if ($user) {
                            Notification::make()
                            ->title('Utilisateur créé avec succès.')
                            ->success()
                            ->send();
                        } else {
                            Notification::make()
                            ->title('Erreur lors de la création de l\'utilisateur.')
                            ->danger()
                            ->send();
                        }
                    })
                    ->requiresConfirmation()
                    ->visible(fn (Marin $record) =>$record->user === null && auth()->user()->can('users.store')),
                    
                // Fin Bouton 
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
            'index' => Pages\ListMarins::route('/'),
            'create' => Pages\CreateMarin::route('/create'),
            'edit' => Pages\EditMarin::route('/{record}/edit'),
            'associate' => Pages\AssociateMarin::route('/{record}/associate'),
        ];
    }
}
