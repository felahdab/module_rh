<?php

namespace Modules\RH\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Modules\RH\Models\User;
use Modules\RH\Models\Marin;
use Modules\RH\Models\Unite;
use App\Service\AnnudefAjaxRequestService;
use Modules\RH\Services\AnnudefUniteService;

class VerifierDonneesIndividuelles extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $name = 'rh:verifier_les_donnees_individuelles';

    /**
     * The console command description.
     */
    protected $description = 'Permet de verifier les donnees individuelles en utilisant Annudef';

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            //['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            //['users', null, InputOption::VALUE_OPTIONAL, 'Examiner les utilisateurs ?', true],
            //['marins', null, InputOption::VALUE_OPTIONAL, 'Examiner les marin ?', true],
        ];
    }

    /**
    * Execute the console command.
    */
    public function handle()
    {
        
        $liste_des_users =  User::all();
        $liste_des_marins =  User::all();

        $nb = count($liste_des_users) + count($liste_des_marins);
        $this->info("Nombre de verifications a faire: {$nb}");

        foreach ($liste_des_users as $verification)
        {
            $this->verifier($verification);
        }
        foreach ($liste_des_marins as $verification)
        {
            $this->verifier($verification);
        }
        
    }

    public function verifier($verification)
    {
        $class = $verification::class;
        $email = $verification->email;
            
        $this->info("Verification de: {$email} ({$class})");

        $fiche_annudef = AnnudefAjaxRequestService::getUserAnnudefEntryByEmail($email);
        if ($fiche_annudef == null)
        {
            $this->warn("Utilisateur inconnu dans Annudef. Abandon.");
            return;
        }

        $fiche_annudef["unite"] = Str::of($fiche_annudef["unite"])->chopEnd('/');

        $unite_calculee = AnnudefUniteService::getUniteFromAnnudefBranch($fiche_annudef["unite"]);
        if ($unite_calculee == null)
        {
            $this->gerer_unite_inconnue($fiche_annudef["unite"]);
            $unite_calculee = AnnudefUniteService::getUniteFromAnnudefBranch($fiche_annudef["unite"]);
            if ($unite_calculee == null )
            {
                $this->warn("Vous n'avez pas corrigé l'unité identifiée par cette branche Annudef. Arrêt du traitement de cet email.");
                return;
            }
        }

        $this->table(["Email", "Unité Annudef", "Unité actuelle"], [[$verification->email, $unite_calculee->libelle_long, $verification->getUnite()?->libelle_long ]]);

        if ($verification->getUnite()?->id != $unite_calculee->id)
        {
            $this->gerer_discordance_des_unites($verification, $fiche_annudef, $unite_calculee);
        }

    }

    public function gerer_unite_inconnue($branche_annudef)
    {
        $this->warn("La branche Annudef {$branche_annudef} ne permet pas de déterminer une unité locale");

        $unite_existante = Unite::where("libelle_long", $this->anticipate("A quelle unité cette branche Annudef correspond-elle ?", function(string $input){
            return Unite::whereLike("libelle_long", "%{$input}%")
                ->pluck("libelle_long","uuid")
                ->all();
        }))->first();

        if ($unite_existante)
        {
            $this->info($unite_existante);
        }
        else
        {
            if ($this->confirm("Aucune unité sélectionnée. Voulez-vous créér une nouvelle fiche unité ?")) {
                $over = false;
                $libelle_long = "";
                $libelle_court = "";
                $libannudef=  $branche_annudef;

                while (! $over )
                {
                    $libelle_long = $this->ask("Nom de l'unité", $libelle_long);
                    $libelle_court = $this->ask("Nom abrégé de l'unité (trigramme)", $libelle_court);

                    $branche_annudef_pieces =Str::of($branche_annudef)->explode("/");
                    $options = [];
                    while (! $branche_annudef_pieces->count() == 0)
                    {
                        $recherche = (string) $branche_annudef_pieces->join("/");
                        $options[] = $recherche;
                        $branche_annudef_pieces->pop();
                    }

                    //$libannudef= $this->ask("Quelle partie de la branche Annudef identifie cette unité ?", $libannudef);
                    $libannudef= $this->choice("Quelle partie de la branche Annudef identifie cette unité ?", $options);

                    if ($this->confirm("Est-ce que les informations saisies sont correctes ?"))
                    {
                        $nouvelle_unite = Unite::create([
                            "libelle_long" => $libelle_long,
                            "libelle_court" => $libelle_court,
                            "libannudef" => $libannudef
                        ]);
        
                        $over = true;
                    }
                }
            
            }
        }
    }

    public function gerer_discordance_des_unites($verification, $fiche_annudef, $unite_calculee)
    {
        $this->table(["email",  "Unite Annudef", "Unite actuelle"], [[$verification->email, $unite_calculee->libelle_long, $verification->getUnite()?->libelle_long ]]);
        
        if ($this->confirm("Voulez-vous corriger la fiche de l'utilisation ou du marin pour lui attribuer l'unité extraite d'Annudef ?"))
        {
            $verification->setUnite($unite_calculee);
        }
    }
}
