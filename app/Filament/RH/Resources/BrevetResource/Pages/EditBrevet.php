<?php

namespace Modules\RH\Filament\RH\Resources\BrevetResource\Pages;

use Modules\RH\Filament\RH\Resources\BrevetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBrevet extends EditRecord
{
    protected static string $resource = BrevetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
