<?php

namespace Modules\RH\Filament\RH\Resources\TypeUniteResource\Pages;

use Modules\RH\Filament\RH\Resources\TypeUniteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeUnites extends ListRecords
{
    protected static string $resource = TypeUniteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
