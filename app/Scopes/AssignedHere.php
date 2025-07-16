<?php

namespace Modules\RH\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

use Modules\RH\Models\Unite;
use App\Models\Setting;

class AssignedHere implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $default_unite = Unite::find(Setting::forKey('rh')->get('unite_par_defaut'));
        if ($default_unite != null){
            $builder->where('unite_id', $default_unite->id);
        }
    }
}