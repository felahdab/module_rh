<?php

namespace Modules\RH\Filament\RH\Resources\TypeUniteResource\Pages;

use Filament\Actions\DeleteAction;
use Modules\RH\Filament\RH\Resources\TypeUniteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeUnite extends EditRecord
{
    protected static string $resource = TypeUniteResource::class;
    protected static ?string $title = "Modifier type d'unité";

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
