<?php

namespace Modules\RH\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Modules\RH\Events\UnMarinDoitEtreCreeEvent;
use Modules\RH\Models\Marin;

class CreateMarinListerner
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
    // public function handle($event)
    public function handle(UnMarinDoitEtreCreeEvent $event)
    {
        $description = $event->description;
        $marin = new Marin;
        
        $marin->nom=$description->nom;
        $marin->prenom=$description->prenom;
        $marin->email=$description->email;

        $marin->display_name = $marin->prenom . " " . $marin->nom;
        
        $marin->save();
        $marin->refresh();


    }
}
