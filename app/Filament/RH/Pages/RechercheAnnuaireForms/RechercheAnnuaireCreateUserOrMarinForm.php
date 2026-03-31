<?php
 
namespace Modules\RH\Filament\RH\Pages\RechercheAnnuaireForms;
 
use Filament\Schemas\Components\Wizard\Step;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms;
 
use App\Models\Role;
use App\Models\User;

use Modules\RH\Models\Marin;
use Modules\RH\Models\Grade;
use Modules\RH\Models\Specialite;
use Modules\RH\Models\Brevet;
use Modules\RH\Models\Unite;

use Modules\RH\Services\AnnudefUniteService;
 
class RechercheAnnuaireCreateUserOrMarinForm
{
    public static function getSchema(array|string|null $rolePrefixes = null)
    {
        $prefixes= $rolePrefixes ? (array) $rolePrefixes : null;
    return [
        Step::make('Utilisateur')
                ->hidden(fn ($record) => ! auth()->user()->can('create', User::class) || User::where('email', $record->email)->first() != null)
                ->schema([
                    Placeholder::make('utilisateur_deja_connu')
                        ->label("Un utilisateur avec cette adresse email est déjà connu")
                        ->disabled()
                        ->visible(fn($record) => User::where('email', $record->email)->first() != null)
                        ->content(function($record)
                        {
                            $user = User::where('email', $record->email)->first();
                            return $user->display_name . '/' . $user->email ;
                        }),
                   
                    Toggle::make('user')
                        ->visible(function ($record) {
                             return User::where('email', $record->email)->first() == null;
                        })
                        ->label("Créer un compte utilisateur ?")
                        ->live(),
                   
                    Select::make('roles')
                        ->visible(function ($record, Get $get) {
                            // VISIBLE seulement si : admin complet ET utilisateur n'existe pas ET toggle activé
                            return 
                            //static::canAccessAdminMenus() &&
                                   User::where('email', $record->email)->first() == null &&
                                   $get('user') === true;
                        })
                        ->label("Rôles à attribuer")
                        // ->options(function() {
                        //     return Role::all()->pluck('name', 'id');
                        // })
                        ->options(function() use ($prefixes) {
                            $query = Role::query();
                            if ($prefixes) {
                                $query->where(function ($q) use ($prefixes) {
                                    foreach ($prefixes as $prefix) {
                                        $q->orWhere('name', 'like', $prefix . '::%');
                                    }
                                });
                            }
                            return $query->pluck('name', 'id');
                        })
                        ->multiple()
                        ->requiredIf('user', true)
                        ->default([]),
                    
                    Forms\Components\Toggle::make('attribuer_unite')
                        ->label("Attribuer une unité à cet utilisateur ?")
                        ->visible(function ($record, Get $get) {
                            return $get('user') === true;
                        })
                        ->live(),
                    
                    Forms\Components\Select::make('unite_id')
                        ->visible(function ($record, Get $get) {
                            return $get('attribuer_unite') === true;
                        })
                        ->label("Unite à attribuer")
                        ->helperText("Si une unité est présélectionnée, c'est qu'elle a été identifiée sur la base de la branche ANNUDEF de cet utilisateur.")
                        ->options(function() {
                            return Unite::orderBy('libelle_long')->pluck("libelle_long", "id");
                        })
                        ->requiredIf('attribuer_unite', true),

                 ]),
               
            Step::make('Marin')
                ->visible(fn ($record) => auth()->user()->can('create', Marin::class) && Marin::where('nid', $record->nid)->first() == null)
                ->schema([
                    Placeholder::make('marin_deja_connu')
                        ->label("Un marin avec ce NID est déjà présent en base")
                        ->disabled()
                        ->visible(fn($record) => Marin::where('nid', $record->nid)->first() != null)
                        ->content(function($record)
                        {
                            $marin = Marin::where('nid', $record->nid)->first();
                            return $marin->nom . ' ' . $marin->prenom . ' / ' . $marin->nid ;
                        }),
                   
                    Toggle::make('marin')
                        ->visible(function ($record) {
                            // VISIBLE seulement si : admin complet ET marin n'existe pas
                            return 
                            //static::canAccessAdminMenus() &&
                                   Marin::where('nid', $record->nid)->first() == null;
                        })
                        ->label("Créer une fiche Marin ?")
                        ->live(),
                   
                    Section::make('Données complémentaires pour la fiche du marin')
                        ->visible(function ($record, Get $get) {
                            // VISIBLE seulement si : admin complet ET marin n'existe pas ET toggle activé
                            return 
                            // static::canAccessAdminMenus() &&
                                   Marin::where('nid', $record->nid)->first() == null &&
                                   $get('marin') === true;
                        })
                        ->columns(4)
                        ->schema([
                            TextInput::make('nid')
                                ->maxLength(15)
                                ->default('')
                                ->requiredIf('marin', true),
                            TextInput::make('matricule')
                                ->maxLength(20)
                                ->default(''),
                            DatePicker::make('date_embarq'),
                            DatePicker::make('date_debarq'),
                            Select::make('grade_id')
                                ->label("Grade")
                                ->options(Grade::all()->pluck('libelle_long', 'id')),
                            Select::make('specialite_id')
                                ->label("Specialite")
                                ->options(Specialite::all()->pluck('libelle_long', 'id')),
                            Select::make('brevet_id')
                                ->label("Brevet")
                                ->options(Brevet::all()->pluck('libelle_long', 'id')),
                            Select::make('unite_id')
                                ->label("Unite")
                                ->options(Unite::orderBy('libelle_long')->pluck('libelle_long', 'id')),
                        ]),
                ]),
        ];
    }
}
