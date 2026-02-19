<?php

namespace Modules\RH\Filament\RH\Resources\SpecialiteResource\Pages;

use Filament\Actions\CreateAction;
use Modules\RH\Filament\RH\Resources\SpecialiteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpecialites extends ListRecords
{
    protected static string $resource = SpecialiteResource::class;
    protected static ?string $title = 'Spécialités';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
