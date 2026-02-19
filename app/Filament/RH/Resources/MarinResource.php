<?php

namespace Modules\RH\Filament\RH\Resources;

use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Modules\RH\Filament\RH\Resources\MarinResource\Pages\AssociateMarin;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Modules\RH\Filament\RH\Resources\MarinResource\Pages\ListMarins;
use Modules\RH\Filament\RH\Resources\MarinResource\Pages\CreateMarin;
use Modules\RH\Filament\RH\Resources\MarinResource\Pages\EditMarin;
use Modules\RH\Filament\RH\Resources\MarinResource\Pages;
use Modules\RH\Filament\RH\Resources\MarinResource\RelationManagers;
use Modules\RH\Models\Marin;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;

use App\Models\Setting;

use Modules\RH\Models\Unite;
use Modules\RH\Jobs\ConfirmMarinUuidJob;

class MarinResource extends Resource
{
    protected static ?string $model = Marin::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Marins';
    protected static ?string $navigationLabel= 'Marins';


    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-academic-cap';

    // Pour modifier slug (doc dans ressources)
    //protected static ?string $slug = 'toto';

    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }



    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')
                    ->required()
                    ->autofocus()
                    ->maxLength(1500)
                    ->label('Nom'),
                Select::make('grade_id')
                    ->relationship('grade', 'libelle_long', fn($query) => $query->orderBy('ordre'))
                    ->label('Grade'),
                TextInput::make('prenom')
                    ->required()
                    ->maxLength(1000)
                    ->label('Prénom'),
                Select::make('brevet_id')
                    ->relationship('brevet', 'libelle_long', fn($query) => $query->orderBy('ordre'))
                    ->label('Brevet'),
                TextInput::make('email')
                    ->unique(
                        table: 'rh_marins',
                        column: 'email',
                        ignoreRecord : true
                    )
                    ->required()
                    ->label('Email'),
                Select::make('specialite_id')
                    ->relationship('specialite', 'libelle_court', fn($query) => $query->orderBy('libelle_court'))
                    ->label('Spécialité'),
                TextInput::make('matricule')
                    ->maxLength(20)
                    ->default('')
                    ->label('Matricule'),
                Select::make('unite_id')
                    ->relationship('unite', 'libelle_court', fn($query) => $query->orderBy('libelle_court'))
                    ->label('Unité'),
                TextInput::make('nid')
                    ->maxLength(15)
                    ->default('')
                    ->label('NID'),
                // DatePicker::make('date_embarq'),
                // DatePicker::make('date_debarq'),
                 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description("Cette table affiche la liste des fiches de marin et permet notamment de savoir si les utilisateurs sont associés à une unité.
                La visibilité de certaines informations ou fonctionnalités est conditionnée par le fait que l'utilisateur est assigné à une unité ou pas.
                Les règles précises dépendent de chaque module. Pour pouvoir attribuer une unité, vous devez disposer de l'autorisation 
                rh::attribuer_une_unite_a_un_utilisateur")
            ->defaultSort('nom','asc')
            ->columns([
                TextColumn::make('id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('ID')
                    ->searchable(),
                TextColumn::make('grade.libelle_court')
                    ->searchable()
                    ->label('Grade'),
                TextColumn::make('brevet.libelle_court')
                    ->searchable()
                    ->label('Brevet'),
                TextColumn::make('specialite.libelle_court')
                    ->searchable()
                    ->label('Spécialité'),
                TextColumn::make('nom')
                    ->searchable()
                    ->label('Nom'),
                TextColumn::make('prenom')
                    ->searchable()
                    ->label('Prénom'),
                TextColumn::make('unite.libelle_court')
                    ->searchable()
                    ->label('Unité'),
                TextColumn::make('matricule')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable()
                    ->label('Matricule'),
                TextColumn::make('nid')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable()
                    ->label('NID'),
                // TextColumn::make('date_embarq')
                //     ->toggleable(isToggledHiddenByDefault: true)
                //     ->date()
                //     ->sortable(),
                // TextColumn::make('date_debarq')
                //     ->toggleable(isToggledHiddenByDefault: true)
                //     ->date()
                //     ->sortable(),
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
            ->recordActions([
                EditAction::make()
                ->iconButton()
                ->icon('heroicon-m-pencil-square')
                ->extraAttributes([
                    'title' => 'Modifier',
                    'class' => 'btn-modif',
                    ]),
                Action::make('associer-a-un-utilisateur')
                ->iconButton()
                ->icon('heroicon-m-users')
                ->extraAttributes([
                    'title' => 'Associer à un utilisateur',
                    'class' => 'btn-modif',
                    ])
                ->url(
                    function($record)
                    {
                        return AssociateMarin::getUrl(["record" => $record]);
                    }
                ),
                Action::make('verifier-avec-serveur-distant')
                    ->iconButton()
                    ->icon('heroicon-m-server-stack')
                    ->extraAttributes([
                        'title' => 'Vérifier avec le serveur distant',
                        'class' => 'btn-modif',
                        ])
                    ->visible(fn() => Setting::forKey("rh")->get("use_remote_rh_server") != null)
                    ->action(function(Marin $record)
                    {
                        ConfirmMarinUuidJob::dispatch($record->uuid);
                    }),
               
                // Bouton pour creer un user 
                Action::make('createUser')
                    ->label('Créer Utilisateur')
                    ->iconButton()
                    ->icon('heroicon-m-user-plus')
                    ->extraAttributes([
                        'title' => "Créer un compte de connexion",
                        'class' => 'btn-modif',
                        ])
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
            'index' => ListMarins::route('/'),
            'create' => CreateMarin::route('/create'),
            'edit' => EditMarin::route('/{record}/edit'),
            'associate' => AssociateMarin::route('/{record}/associate'),
        ];
    }
}
