<?php

namespace Modules\RH\Filament\RH\Pages\RechercheAnnuaireForms;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
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
        Wizard\Step::make('Utilisateur')
                ->schema([
                Toggle::make('user')
                    ->visible(fn () => auth()->user()->can('create', User::class))
                    ->label("Créér un compte utilisateur ?")
                    ->live(),
                Select::make('roles')
                    ->disabled(fn (Get $get) => ! $get('user'))
                    ->label("Rôles à attribuer")
                    ->options(Role::all()->pluck('name', 'id'))
                    ->multiple()
                    ->requiredIf('user', true)
                ]),
        Wizard\Step::make('Marin')
            ->schema([
                Toggle::make('marin')
                    ->visible(fn () => auth()->user()->can('create', Marin::class))
                    ->label("Créér une fiche Marin ?")
                    ->live(),
                Section::make('Données complémentaires pour la fiche du marin')
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
