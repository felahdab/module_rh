<?php

namespace Modules\RH\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Modules\RH\Events;
use Modules\RH\Listeners;
use App\Events\UnUtilisateurLocalAEteCreeEvent;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Events\UnMarinDoitEtreCreeEvent::class => [
            Listeners\CreateMarinListener::class,
        ],
        Events\UneUniteDoitEtreAttribueeAUnUtilisateurEvent::class => [
            Listeners\AttribueUniteAUnUtilisateurListener::class
        ],
        UnUtilisateurLocalAEteCreeEvent::class => [
            Listeners\AssocierUneUniteAUnNouvelUtilisateur::class,
            Listeners\EssayerDeCreerUnMarinAssocieAUnNouvelUtilisateur::class
        ]
    ];
}
