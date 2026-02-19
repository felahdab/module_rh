<?php
namespace  Modules\RH\Services;

use Illuminate\Support\Str;

use Modules\RH\Models\Unite;

class AnnudefUniteService
{
    public static function getUniteFromAnnudefBranch(string $annudef_branch) : ?Unite
    {
        $annudef_branch = Str::of($annudef_branch)->chopEnd('/');

        $pieces = Str::of($annudef_branch)->explode("/");
        
        $unite = null;
        while ($unite == null && ! $pieces->count() == 0)
        {
            $recherche = (string) $pieces->join("/");
            $unite = Unite::where("libannudef", $recherche)->first();
            $pieces->pop();
        }

        return $unite;
    }
}