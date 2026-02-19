<?php

namespace Modules\RH\Listeners;

use Illuminate\Support\Arr;

use Modules\RH\Events\UnMarinDoitEtreCreeEvent;
use Modules\RH\Models\Marin;
use Modules\RH\Models\Unite;

class CreateMarinListener
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
        $description = $event->description->toArray();

        $unite_id = Arr::get($description, "unite_id");
        $description = Arr::except($description, "unite_id");
        
        $marin = Marin::create($description);

        $unite = Unite::find($unite_id);
        $marin->setUnite($unite);

    }
}
