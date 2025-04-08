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
//        ddd($description->toArray());
        $marin = Marin::create($description->toArray());

    }
}
