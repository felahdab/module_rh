<?php

namespace Modules\RH\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Modules\RH\Events\UnMarinDoitEtreCreeEvent;
use Modules\RH\Listeners\CreateMarinListerner;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UnMarinDoitEtreCreeEvent::class => [
            CreateMarinListerner::class,
        ],
    ];
}
