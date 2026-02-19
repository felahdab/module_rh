<?php

namespace Modules\RH\Filament\RH\Resources\SpecialiteResource\Pages;

use Filament\Actions\DeleteAction;
use Modules\RH\Filament\RH\Resources\SpecialiteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpecialite extends EditRecord
{
    protected static string $resource = SpecialiteResource::class;
    protected static ?string $title = 'Modifier spécialité';

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
