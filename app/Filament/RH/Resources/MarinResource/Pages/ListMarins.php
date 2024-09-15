<?php

namespace Modules\RH\Filament\RH\Resources\MarinResource\Pages;

use Modules\RH\Filament\RH\Resources\MarinResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use Filament\Forms;


class ListMarins extends ListRecords
{
    protected static string $resource = MarinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('test')
            ->requiresConfirmation()
            ->form([
                Forms\Components\TextInput::make('nom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('prenom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('matricule')
                    ->maxLength(20)
                    ->default(''),
                Forms\Components\TextInput::make('nid')
                    ->maxLength(15)
                    ->default(''),
                Forms\Components\DatePicker::make('date_embarq'),
                Forms\Components\DatePicker::make('date_debarq'),
                Forms\Components\TextInput::make('grade_id')
                    ->required()
                    ->maxLength(36),
                Forms\Components\TextInput::make('specialite_id')
                    ->required()
                    ->maxLength(36),
                Forms\Components\TextInput::make('brevet_id')
                    ->required()
                    ->maxLength(36),
                Forms\Components\TextInput::make('secteur_id')
                    ->required()
                    ->maxLength(36),
                Forms\Components\TextInput::make('unite_id')
                    ->required()
                    ->maxLength(36),
                Forms\Components\Textarea::make('data')
                    ->columnSpanFull(),
            ])
            ->action(function(array $data) {
                dump($data);
            })
        ];
    }
}
