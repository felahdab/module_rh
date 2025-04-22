<?php

namespace Modules\RH\Filament\RH\Resources\BrevetResource\Pages;

use Modules\RH\Filament\RH\Resources\BrevetResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\RH\Models\Brevet;

class CreateBrevet extends CreateRecord
{
    protected static string $resource = BrevetResource::class;

    // faire en sorte que l'ordre se décale si insertion au milieu.
    protected function handleRecordCreation(array $data): Model
    {
        $ordre=$data['ordre'];
        $list_brevets=Brevet::where('ordre', '>=' , $ordre)->get();
        foreach($list_brevets as $brevet){
            $brevet->ordre ++;
            $brevet->save();
        }
        return static::getModel()::create($data);
    }

}
