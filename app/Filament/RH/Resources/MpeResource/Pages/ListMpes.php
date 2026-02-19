<?php

namespace Modules\RH\Filament\RH\Resources\MpeResource\Pages;

use Filament\Actions\CreateAction;
use Modules\RH\Filament\RH\Resources\MpeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMpes extends ListRecords
{
    protected static string $resource = MpeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
