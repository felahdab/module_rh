<?php

namespace Modules\RH\Filament\RH\Resources\MarinResource\Pages;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Modules\RH\Filament\RH\Resources\MarinResource;
use Modules\RH\Filament\RH\Resources\MarinResource\Widgets\UserTable;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;


class AssociateMarin extends ViewRecord
{
    protected static string $resource = MarinResource::class;

    protected static ?string $title = "Associer un marin à un utilisateur";

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nom')
                ->required()
                ->maxLength(255),
            TextInput::make('prenom')
                ->required()
                ->maxLength(255),
            TextInput::make('matricule')
                ->maxLength(20)
                ->default(''),
            TextInput::make('nid')
                ->maxLength(15)
                ->default(''),
        ]);
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form($this->makeForm()
                    ->operation('view')
                    ->disabled()
                    ->model($this->getRecord())
                    ->statePath($this->getFormStatePath())
                    ->columns($this->hasInlineLabels() ? 1 : 2)
                    ->inlineLabel($this->hasInlineLabels()),
            ),
        ];
    }

    public function getFooterWidgets(): array
    {
        return [
            UserTable::class,
        ];
    }
}
