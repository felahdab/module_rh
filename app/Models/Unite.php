<?php

namespace Modules\RH\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Modules\RH\Traits\HasTablePrefix;

use Modules\RH\Models\Marin;

class Unite extends Model
{
    use HasFactory;
	use HasTablePrefix;

	protected $fillable = [
		'id',
		'uuid',
		'libelle_court', 
		'libelle_long', 
		'ordre',
	];
	
	public function marins()
	{
		return $this->hasMany(Marin::class);
	}
}
