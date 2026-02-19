<?php
namespace Modules\RH\Filament\RH\Resources\UserResource\Actions;

use Filament\Tables\Actions\Action;
use Filament\Forms;

use Modules\RH\Models\Unite;
use Modules\RH\Events\UneUniteDoitEtreAttribueeAUnUtilisateurEvent;

class RetirerUneUniteAUnUtilisateurAction extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name)
        ->visible(fn($record) => auth()->check() && auth()->user()->can("rh::attribuer_une_unite_a_un_utilisateur") && $record->getUnite() != null)
            ->requiresConfirmation()
            ->action(function($record){
                $unite = null;
                $user = $record;

                UneUniteDoitEtreAttribueeAUnUtilisateurEvent::dispatch($user,$unite);
            });
    }

}