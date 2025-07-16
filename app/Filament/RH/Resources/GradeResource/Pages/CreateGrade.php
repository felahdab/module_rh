<?php

namespace Modules\RH\Filament\RH\Resources\GradeResource\Pages;

use Modules\RH\Filament\RH\Resources\GradeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\RH\Models\Grade;

class CreateGrade extends CreateRecord
{
    protected static string $resource = GradeResource::class;
    protected static ?string $title = 'Créer grade';

    // faire en sorte que l'ordre se décale si insertion au milieu.
    protected function handleRecordCreation(array $data): Model
    {
        $ordre=$data['ordre'];
        $list_grades=Grade::where('ordre', '>=' , $ordre)->get();
        foreach($list_grades as $grade){
            $grade->ordre ++;
            $grade->save();
        }
        return static::getModel()::create($data);
    }
}
