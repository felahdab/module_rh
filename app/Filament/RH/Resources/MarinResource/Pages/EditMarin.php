<?php

namespace Modules\RH\Filament\RH\Resources\MarinResource\Pages;

use Modules\RH\Filament\RH\Resources\MarinResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class EditMarin extends EditRecord
{
    protected static string $resource = MarinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('createUser')
                ->label('Créer Utilisateur')
                ->action(function(){
                    $record = $this->record;
                    $user = $record->createUser();
                        if ($user) {
                            Notification::make()
                            ->title('Utilisateur créé avec succès.')
                            ->success()
                            ->send();
                        } else {
                            Notification::make()
                            ->title('Erreur lors de la création de l\'utilisateur.')
                            ->danger()
                            ->send();
                        }
                    })
                ->requiresConfirmation()
                ->visible(fn () => auth()->user()->can('users.store')),
               
        ];
    }

    protected function afterSave(): void
    {
        // Notification
        // Notification::make()
        //     ->title('Marin modifié avec succès')
        //     ->success()
        //     ->send();
        
        // Redirection en fonction Module
        // dd(request()->fullUrl());
        // if (request()->query('type')==='fcmcommun')
        // {
           
        //     $this->redirectRoute('filament.ressources.fcm-commun/marins.index');
        // }
    }
}
