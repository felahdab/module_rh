<?php

namespace Modules\RH\Filament\RH\Resources\MarinResource\Pages;

use Modules\RH\Filament\RH\Resources\MarinResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateMarin extends CreateRecord
{
    protected static string $resource = MarinResource::class;

    protected function afterSave(): void
    {
        // Notification
        // Notification::make()
        //     ->title('Marin créé avec succès')
        //     ->success()
        //     ->send();
        // dd(request());
        // // Redirection en fonction Module
        // if (request()->is('*/create/fcmcommun'))
        // {
        //     $this->redirectRoute('filament.ressources.fcm-commun/marins.index');
        // }
    }
}
