<?php

namespace Modules\RH\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

use Modules\RH\Models\User;
use Modules\RH\Models\Unite;
use Modules\RH\Models\Marin;

class MarinFiltreParUniteScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        /**
         * On ne se préoccupe de scoper le modèle que lorsque l'utilisateur est authentifié.
         */
        if (! auth()->check() ) return;

        /**       
         * Si l'utilisateur a la permission rh::voir_tous_les_marins, il peut voir tous les marins
         * Donc on ne change rien.
         */
        $user = auth()->user();
        if ($user->can('rh::voir_tous_les_marins')) return;

        /**
         * Pour faire les vérifications vis à vis de l'unité d'affectation de l'utilisateur,
         * il faut transformer l'objet auth()->user() en objet de la classe Modules\RH\Models\User
         * Pour cela, on utilise le caster
         */
        $user = cast_as_eloquent_descendant($user, User::class);
        $unite = $user->getUnite(explore_marin: true); // Ici, on regarde si l'utilisateur a une unite, soit
        // directement, soit au travers d'une éventuelle fiche de Marin qui lui serait associée.

        /**
         * On regarde si l'utilisateur est associé à un Marin
         */
        $marin = Marin::fromUser($user);

        /**
         * Si l'utilisateur n'a pas d'unité d'affectation, on ne lui donne accès à aucun dossier de marin sauf le siens.
         */
        if ($unite == null){
            if ($marin != null){
                $builder->whereIn('id', [$marin->id]);
                return;
            }
            else {
                // Sinon, on ne lui donne aucun marin du tout.
                $builder->whereRaw('1 = 0');
                return;
            }
            
        } 

        /**
         * Et enfin, si l'utilisateur a une unité d'affectation, on lui donne les marins qui sont affectés
         * dans cette même unité.
         */
        $builder->where('unite_id', $unite->id);


    }
}
