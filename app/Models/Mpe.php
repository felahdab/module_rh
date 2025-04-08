<?php

namespace Modules\RH\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\RH\Database\Factories\MpeFactory;

use Modules\RH\Traits\HasTablePrefix;

class Mpe extends Model
{
    use HasFactory;
	use HasTablePrefix;



    protected $fillable = [
		'id',
		'uuid',
		'marin_id', 
		'unite_id', 
		'sansadate',
		'date_debut',
		'date_fin',
	];

    protected static function newFactory(): MpeFactory
    {
        return MpeFactory::new();
    }
	
	public function marin()
	{
		return $this->belongsTo(Marin::class, 'marin_id', 'id');
	}


    public function unite()
    {
        return $this->belongsTo(Unite::class, 'unite_id', 'id');
    }
}