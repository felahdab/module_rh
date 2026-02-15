<?php

namespace Modules\RH\Filament\RH\Resources\TypeUniteResource\Pages;

use Filament\Actions\CreateAction;
use Modules\RH\Filament\RH\Resources\TypeUniteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeUnites extends ListRecords
{
    protected static string $resource = TypeUniteResource::class;

    protected static ?string $title = "Types d'unité";

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
