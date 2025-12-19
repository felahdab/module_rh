<?php

namespace Modules\RH\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Modules\RH\Traits\HasTablePrefix;
use Modules\RH\Database\Factories\SpecialiteFactory;


class Specialite extends Model
{
    use HasFactory;
    use HasTablePrefix;

    protected $fillable = [
        'id',
        'uuid',
        'libelle_long',
        'libelle_court',
        'data',
        'ordre'
    ];

    public function marins()
	{
		return $this->hasMany(Marin::class, 'specialite_id', 'id');
	}

    protected static function newFactory(): SpecialiteFactory
    {
        return SpecialiteFactory::new();
    }
}
