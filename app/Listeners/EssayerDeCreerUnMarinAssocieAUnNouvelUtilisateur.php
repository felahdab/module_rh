<?php

namespace Modules\RH\Listeners;

use App\Events\UnUtilisateurLocalAEteCreeEvent;
use Modules\RH\Services\AnnudefUniteService;
use Modules\RH\Services\AnnudefGradeService;
use Modules\RH\Models\User;
use Modules\RH\Models\Marin;

class EssayerDeCreerUnMarinAssocieAUnNouvelUtilisateur
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
        $possible_grade = AnnudefGradeService::getGradeFromAnnudefRank($description->gradelong);
        logger()->info("Grade identifie a partir l information annuaire: ", ["user" => $already_existing_user, "grade" => $possible_grade]);

        if ($possible_unit && $possible_grade)
        {
            $description = $description->toArray();
            $description["unite_id"] = $possible_unit->id;
            $description["grade_id"] = $possible_grade->id;
            
            $marin = Marin::create($description);

            $marin->setUser($already_existing_user);
            logger()->info("Marin cree et associe a l utilisateur", ["user" => $already_existing_user, "marin" => $marin]);
        }


    }
}
