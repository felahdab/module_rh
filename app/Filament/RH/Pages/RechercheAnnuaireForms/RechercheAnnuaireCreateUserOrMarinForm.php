<?php
 
namespace Modules\RH\Filament\RH\Pages\RechercheAnnuaireForms;
 
use Filament\Forms;
use Filament\Forms\Get;
 
use App\Models\Role;
use App\Models\User;
use Modules\RH\Models\Marin;
use Modules\RH\Models\Grade;
use Modules\RH\Models\Specialite;
use Modules\RH\Models\Brevet;
use Modules\RH\Models\Unite;

 
class RechercheAnnuaireCreateUserOrMarinForm
{
    
 
    public static function getSchema()
    {
       
        return [
            
            Forms\Components\Wizard\Step::make('Utilisateur')
                ->schema([
                    Forms\Components\Placeholder::make('utilisateur_deja_connu')
                        ->label("Un utilisateur avec cette adresse email est déjà connu")
                        ->disabled()
                        ->visible(fn($record) => User::where('email', $record->email)->first() != null)
                        ->content(function($record)
                        {
                            $user = User::where('email', $record->email)->first();
                            return $user->display_name . '/' . $user->email ;
                        }),
                   
                    Forms\Components\Toggle::make('user')
                        ->visible(function ($record) {
                            // VISIBLE seulement si : admin complet ET utilisateur n'existe pas
                            return static::canAccessAdminMenus()  &&
                                   User::where('email', $record->email)->first() == null;
                        })
                        ->label("Créer un compte utilisateur ?")
                        ->live(),
                   
                    Forms\Components\Select::make('roles')
                        ->visible(function ($record, Get $get) {
                            // VISIBLE seulement si : admin complet ET utilisateur n'existe pas ET toggle activé
                            return static::canAccessAdminMenus() &&
                                   User::where('email', $record->email)->first() == null &&
                                   $get('user') === true;
                        })
                        ->label("Rôles à attribuer")
                        ->options(function() {
                            return Role::all()->pluck('name', 'id');
                        })
                        ->multiple()
                        ->requiredIf('user', true)
                        ->default([]),
 
                        // Message informatif pour les non-admins
                    Forms\Components\Placeholder::make('access_denied')
                    ->label("Accès limité")
                    ->visible(function () {
                        return !static::canAccessAdminMenus();
                    })
                    ->content("Seuls les administrateurs peuvent créer des comptes utilisateurs et des fiches marin depuis cette interface."),
                ]),
               
            Forms\Components\Wizard\Step::make('Marin')
                ->schema([
                    Forms\Components\Placeholder::make('marin_deja_connu')
                        ->label("Un marin avec ce NID est déjà présent en base")
                        ->disabled()
                        ->visible(fn($record) => Marin::where('nid', $record->nid)->first() != null)
                        ->content(function($record)
                        {
                            $marin = Marin::where('nid', $record->nid)->first();
                            return $marin->nom . ' ' . $marin->prenom . ' / ' . $marin->nid ;
                        }),
                   
                    Forms\Components\Toggle::make('marin')
                        ->visible(function ($record) {
                            // VISIBLE seulement si : admin complet ET marin n'existe pas
                            return static::canAccessAdminMenus() &&
                                   Marin::where('nid', $record->nid)->first() == null;
                        })
                        ->label("Créer une fiche Marin ?")
                        ->live(),
                   
                    Forms\Components\Section::make('Données complémentaires pour la fiche du marin')
                        ->visible(function ($record, Get $get) {
                            // VISIBLE seulement si : admin complet ET marin n'existe pas ET toggle activé
                            return static::canAccessAdminMenus() &&
                                   Marin::where('nid', $record->nid)->first() == null &&
                                   $get('marin') === true;
                        })
                        ->columns(4)
                        ->schema([
                            Forms\Components\TextInput::make('nid')
                                ->maxLength(15)
                                ->default('')
                                ->requiredIf('marin', true),
                            Forms\Components\TextInput::make('matricule')
                                ->maxLength(20)
                                ->default(''),
                            Forms\Components\DatePicker::make('date_embarq'),
                            Forms\Components\DatePicker::make('date_debarq'),
                            Forms\Components\Select::make('grade_id')
                                ->label("Grade")
                                ->options(Grade::all()->pluck('libelle_long', 'id')),
                            Forms\Components\Select::make('specialite_id')
                                ->label("Specialite")
                                ->options(Specialite::all()->pluck('libelle_long', 'id')),
                            Forms\Components\Select::make('brevet_id')
                                ->label("Brevet")
                                ->options(Brevet::all()->pluck('libelle_long', 'id')),
                            Forms\Components\Select::make('unite_id')
                                ->label("Unite")
                                ->options(Unite::all()->pluck('libelle_long', 'id')),
                        ]),
                       
                    // Message informatif pour les non-admins
                    Forms\Components\Placeholder::make('access_denied')
                        ->label("Accès limité")
                        ->visible(function () {
                            return !static::canAccessAdminMenus();
                        })
                        ->content("Seuls les administrateurs peuvent créer des comptes utilisateurs et des fiches marin depuis cette interface."),
                ]),
        ];
    }
}
