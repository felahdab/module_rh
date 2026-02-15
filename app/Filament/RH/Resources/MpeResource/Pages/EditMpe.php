<?php

namespace Modules\RH\Filament\RH\Resources\MpeResource\Pages;

use Filament\Actions\DeleteAction;
use Modules\RH\Filament\RH\Resources\MpeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMpe extends EditRecord
{
    protected static string $resource = MpeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
