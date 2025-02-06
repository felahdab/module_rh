<?php

namespace Modules\RH\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\RH\Traits\HasTablePrefix;

// use Modules\RH\Database\Factories\TypeUniteFactory;

class TypeUnite extends Model
{
    use HasFactory;
    use HasTablePrefix;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
		"id",
		"uuid",
		"libelle_long",
		"libelle_court",
		"ordre",
		"data"
	];

    public function unites()
    {
        return $this->hasMany(Unite::class);
    }

    // protected static function newFactory(): TypeUniteFactory
    // {
    //     // return TypeUniteFactory::new();
    // }
}
