<?php

namespace Modules\RH\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Modules\RH\Traits\HasTablePrefix;

class Brevet extends Model
{
    use HasFactory;
	use HasTablePrefix;
	
	protected $fillable = [
		'id',
		'uuid',
		'libelle_long',
		'libelle_court',
		'ordre',
		'data'
	];

}
