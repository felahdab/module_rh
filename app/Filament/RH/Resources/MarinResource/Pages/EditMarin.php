<?php

namespace Modules\RH\Filament\RH\Resources\MarinResource\Pages;

use Modules\RH\Filament\RH\Resources\MarinResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMarin extends EditRecord
{
    protected static string $resource = MarinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
