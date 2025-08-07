<?php

namespace Modules\RH\Filament\RH\Resources\BrevetResource\Pages;

use Modules\RH\Filament\RH\Resources\BrevetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\RH\Models\Brevet;
use Illuminate\Database\Eloquent\Model;

class EditBrevet extends EditRecord
{
    protected static string $resource = BrevetResource::class;
    protected static ?string $title = 'Modifier brevet';

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
            $list_brevets=Brevet::where('ordre', '>' , $old_ordre)
                ->where('ordre', '<=' , $new_ordre)
                ->get();
            // dd($list_brevets);  
            foreach($list_brevets as $brevet){
                $brevet->ordre --;
                $brevet->save();
            }
        }
        else{
            $list_brevets=Brevet::where('ordre', '>=' , $new_ordre)                
                ->where('ordre', '<' , $old_ordre)
                ->get();
            foreach($list_brevets as $brevet){
                $brevet->ordre ++;
                $brevet->save();
        }
    }
        $record->update($data);
    
        return $record;
    }

}
