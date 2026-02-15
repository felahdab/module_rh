<?php

namespace Modules\RH\Filament\RH\Resources\GradeResource\Pages;

use Filament\Actions\CreateAction;
use Modules\RH\Filament\RH\Resources\GradeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGrades extends ListRecords
{
    protected static string $resource = GradeResource::class;
    protected static ?string $title = 'Grades';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
