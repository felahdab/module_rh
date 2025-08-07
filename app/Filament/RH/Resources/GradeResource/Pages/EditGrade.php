<?php

namespace Modules\RH\Filament\RH\Resources\GradeResource\Pages;

use Modules\RH\Filament\RH\Resources\GradeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\RH\Models\Grade;
use Illuminate\Database\Eloquent\Model;


class EditGrade extends EditRecord
{
    protected static string $resource = GradeResource::class;
    protected static ?string $title = 'Modifier grade';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $old_ordre=$record->ordre;
        $new_ordre=$data['ordre'];
        if ($new_ordre > $old_ordre){
            $list_grades=Grade::where('ordre', '>' , $old_ordre)
                ->where('ordre', '<=' , $new_ordre)
                ->get();
            foreach($list_grades as $grade){
                $grade->ordre --;
                $grade->save();
            }
        }
        else{
            $list_grades=Grade::where('ordre', '>=' , $new_ordre)                
                ->where('ordre', '<' , $old_ordre)
                ->get();
            foreach($list_grades as $grade){
                $grade->ordre ++;
                $grade->save();
        }
    }
        $record->update($data);
    
        return $record;
    }
}
