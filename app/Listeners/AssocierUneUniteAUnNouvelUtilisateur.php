<?php

namespace Modules\RH\Listeners;

use App\Events\UnUtilisateurLocalAEteCreeEvent;
use Modules\RH\Services\AnnudefUniteService;
use Modules\RH\Models\User;

class AssocierUneUniteAUnNouvelUtilisateur
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    // public function handle($event)
    public function handle(UnUtilisateurLocalAEteCreeEvent $event)
    {
        $description = $event->description;

        $already_existing_user = User::where('email', $description->email)->first();
        if ($already_existing_user == null) 
        {
            logger()->error("Modules\RH\Listeners\UnUtilisateurLocalAEteCreeListener: l utilisateur invoqué n'existe pas.");
            return;
        }
        
        $possible_unit = AnnudefUniteService::getUniteFromAnnudefBranch($description->unite);
        logger()->info("Unite identifiee a partir de la branche Annudef: ", ["user" => $already_existing_user, "unite" => $possible_unit]);
        if ($possible_unit)
        {
            $already_existing_user->setUnite($possible_unit);
        }
    }
}
