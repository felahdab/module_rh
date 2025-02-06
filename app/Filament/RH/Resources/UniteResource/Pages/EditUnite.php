<?php

namespace Modules\RH\Filament\RH\Resources\UniteResource\Pages;

use Modules\RH\Filament\RH\Resources\UniteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUnite extends EditRecord
{
    protected static string $resource = UniteResource::class;

    protected function getHeaderActions(): array
    {
        return [
           // Actions\DeleteAction::make(),
        ];
    }
}
