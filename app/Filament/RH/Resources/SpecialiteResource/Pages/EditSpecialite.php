<?php

namespace Modules\RH\Filament\RH\Resources\SpecialiteResource\Pages;

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
            Actions\DeleteAction::make(),
        ];
    }
}
