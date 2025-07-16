<?php

namespace Modules\RH\Filament\RH\Resources\MarinResource\Widgets;

use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;

use Modules\RH\Models\User;

class UserTable extends BaseWidget
{
    protected int | string | array $columnSpan = 2;

    public ?Model $record = null;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()            
            )
            ->columns([
                Tables\Columns\TextColumn::make('nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prenom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
            ])
            ->actions([
                Action::make("associate")
                    ->label("Associer à cet utilisateur")
                    ->visible(function($record)
                    {
                        $record_user = $this->record->getUser();
                        if ($record_user == null)
                            return true;
                        return $record_user->id != $record->id;
                    })
                    ->requiresConfirmation()
                    ->action(function($record, $table)
                    {
                        $marin = $this->record;
                        $user = $record;

                        $marin->setUser($user);
                    }),
                Action::make("dissociate")
                    ->label("Séparer de cet utilisateur")
                    ->visible(function($record)
                    {
                        $record_user = $this->record->getUser();
                        if ($record_user == null)
                            return false;
                        return $record_user->id == $record->id;
                    })
                    ->requiresConfirmation()
                    ->action(function($record, $table)
                    {
                        $marin = $this->record;
                        $marin->setUser(null);
                    })

            ]);
    }
}
