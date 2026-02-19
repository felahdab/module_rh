<?php

namespace Modules\RH\Listeners;

use Modules\RH\Events\UneUniteDoitEtreAttribueeAUnUtilisateurEvent;

class AttribueUniteAUnUtilisateurListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UneUniteDoitEtreAttribueeAUnUtilisateurEvent $event)
    {
        $user = $event->user;
        $unite = $event->unite;

        $user->setUnite($unite);

    }
}
