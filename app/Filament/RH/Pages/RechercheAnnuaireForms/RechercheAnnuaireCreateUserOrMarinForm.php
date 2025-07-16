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
                    ->hidden(fn ($record) => ! auth()->user()->can('create', User::class) || User::where('email', $record->email)->first() != null)
                    ->label("Créér un compte utilisateur ?")
                    ->live(),
                Forms\Components\Select::make('roles')
                    ->hidden(fn ($record) => ! auth()->user()->can('create', User::class) || User::where('email', $record->email)->first() != null)
                    ->disabled(fn (Get $get) => ! $get('user'))
                    ->label("Rôles à attribuer")
                    ->options(Role::all()->pluck('name', 'id'))
                    ->multiple()
                    ->requiredIf('user', true)
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
                    ->visible(fn ($record) => auth()->user()->can('create', Marin::class) && Marin::where('nid', $record->nid)->first() == null)
                    ->label("Créér une fiche Marin ?")
                    ->live(),
                Forms\Components\Section::make('Données complémentaires pour la fiche du marin')
                    ->visible(fn ($record) => auth()->user()->can('create', Marin::class) && Marin::where('nid', $record->nid)->first() == null)
                    ->disabled(fn (Get $get) => ! $get('marin'))
                    ->columns(4)
                    ->schema(
                    [
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
                            ->options(Grade::all()->pluck('libelle_long', 'id')),
                        Forms\Components\Select::make('specialite_id')
                            ->options(Specialite::all()->pluck('libelle_long', 'id')),
                        Forms\Components\Select::make('brevet_id')
                            ->options(Brevet::all()->pluck('libelle_long', 'id')),
                        Forms\Components\Select::make('unite_id')
                            ->options(Unite::all()->pluck('libelle_long', 'id')),
                    ]),
                ]),
        
        ];
    }

}
