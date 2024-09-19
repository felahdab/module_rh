<?php

namespace Modules\RH\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\RH\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Marin extends Model
{
    use HasUuids; 
    use HasTablePrefix;

    protected $fillable = [
        'id',
        'nom',
        'prenom',
        'matricule',
        'nid',
        'date_embarq',
        'date_debarq',
        'grade_id',
        'specialite_id',
        'brevet_id',
        'secteur_id',
        'unite_id',
        'data',
    ];

    protected function casts(): array
    {
        return [
            'data' => AsArrayObject::class,
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Marin $marin) {
            $data = ["status" => "pending_uuid_confirmation"];
            $marin->data = $data;
        });
    }
}
