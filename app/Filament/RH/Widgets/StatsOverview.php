<?php

namespace Modules\RH\Filament\RH\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Modules\RH\Models\Marin;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Marins', Marin::count()),
        ];
    }
}
