<?php

namespace Modules\RH\Filament\RH\Resources\UniteResource\Pages;

use Filament\Actions\DeleteAction;
use Modules\RH\Filament\RH\Resources\UniteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUnite extends EditRecord
{
    protected static string $resource = UniteResource::class;
    protected static ?string $title = 'Modifier unité';

    protected function getHeaderActions(): array
    {
        return [
           DeleteAction::make(),
        ];
    }
}
