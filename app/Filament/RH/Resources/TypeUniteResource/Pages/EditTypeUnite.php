<?php

namespace Modules\RH\Filament\RH\Resources\TypeUniteResource\Pages;

use Modules\RH\Filament\RH\Resources\TypeUniteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeUnite extends EditRecord
{
    protected static string $resource = TypeUniteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\DeleteAction::make(),
        ];
    }
}
