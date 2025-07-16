<?php

namespace Modules\RH\Filament\RH\Pages;

use App\Filament\PageTemplates\RechercheAnnuairePageTemplate;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Support\Enums;

use Illuminate\support\Arr;

use App\Events\UnUtilisateurLocalDoitEtreCreeEvent;
use Modules\RH\Events\UnMarinDoitEtreCreeEvent;

use App\Models\Role;
use App\Models\User;
use Modules\RH\Models\Marin;
use Modules\RH\Models\Grade;
use Modules\RH\Models\Specialite;
use Modules\RH\Models\Brevet;
use Modules\RH\Models\Unite;

use Modules\RH\Filament\RH\Pages\RechercheAnnuaireforms\RechercheAnnuaireCreateUserOrMarinForm;

class RechercheAnnuairePage extends RechercheAnnuairePageTemplate
{
    public function getRowActions()
    {
        return [
            Action::make('create-local-user-or-marin')
                ->visible(function(){
                    return auth()->check();
                })
                ->icon('heroicon-o-plus')
                ->label("Créé un utilisateur local et/ou une fiche de marin")
                ->requiresConfirmation()
                ->modalWidth(Enums\MaxWidth::SevenExtraLarge)
                ->form([Wizard::make()->schema(RechercheAnnuaireCreateUserOrMarinForm::getSchema())])
                ->action(function ($record, $data){
                    // array:11 [▼ // vendor/spatie/laravel-ignition/src/helpers.php:14
                    //   "marin" => true
                    //   "matricule" => "123"
                    //   "nid" => "321"
                    //   "date_embarq" => null
                    //   "date_debarq" => null
                    //   "grade_id" => "9"
                    //   "specialite_id" => "8"
                    //   "brevet_id" => "3"
                    //   "unite_id" => "8"
                    //   "user" => true
                    //   "roles" => array:1 [▶]
                    // ]
                    
                    if (Arr::get($data, 'user'))
                    {
                        UnUtilisateurLocalDoitEtreCreeEvent::dispatch($record->toArray(), $data['roles']);
                    }
                    if (Arr::get($data, 'marin'))
                    {
                        $creation_data = array_merge($record->toArray(), $data);
                        if (Arr::get($data, 'user'))
                        {
                            $newUser= User::where('email', $record->email)->first();
                            $creation_data['user_id'] = $newUser->id;
                        }
                        UnMarinDoitEtreCreeEvent::dispatch($creation_data);

                        
                    }
                }),
        ];
    }

    public function getBulkActions()
    {
        return [
            BulkAction::make('create-local-user')
                ->visible(function(){
                    return auth()->check() && auth()->user()->can('users.store');
                })
                ->icon('heroicon-o-plus')
                ->label("Créé l'utilisateur local")
                ->requiresConfirmation()
                ->form([
                    Select::make('roles')
                        ->label("Rôles à attribuer")
                        ->options(Role::all()->pluck('name', 'id'))
                        ->multiple()
                        ->required()
                ])
                ->action(function ($records, $data){
                    foreach($records as $record){
                        UnUtilisateurLocalDoitEtreCreeEvent::dispatch($record->toArray(), $data['roles']);
                    }
                }),
        ];
    }
}
