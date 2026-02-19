<?php
namespace Modules\RH\Filament\RH\Resources\UserResource\Actions;

use Filament\Tables\Actions\Action;
use Filament\Forms;

use Modules\RH\Models\Unite;
use Modules\RH\Events\UneUniteDoitEtreAttribueeAUnUtilisateurEvent;

class AttribuerUneUniteAUnUtilisateurAction extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name)
            ->visible(fn($record) => auth()->check() && auth()->user()->can("rh::attribuer_une_unite_a_un_utilisateur") && $record->getUnite() == null)
            ->requiresConfirmation()
            ->form([
                Forms\Components\Select::make("unite_id")
                    ->label("Unité")
                    ->options(Unite::orderBy('libelle_long')->pluck('libelle_long', 'id'))
                    ->required()
            ])
            ->action(function($record, $data){
                $unite = Unite::find($data["unite_id"]);
                $user = $record;

                UneUniteDoitEtreAttribueeAUnUtilisateurEvent::dispatch($user,$unite);
            });
    }

}