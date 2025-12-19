<?php

namespace Modules\RH\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


use Modules\RH\Traits\HasTablePrefix;
use Modules\RH\Models\Marin;

use Modules\RH\Database\Factories\GradeFactory;


class Grade extends Model
{
    use HasFactory;
	use HasTablePrefix;

	protected $fillable = [
		"id",
		"uuid",
		"libelle_long",
		"libelle_court",
		"ordre",
		"data"
	];
	
	public function marins()
	{
		return $this->hasMany(Marin::class, 'grade_id', 'id');
	}

	protected static function newFactory(): GradeFactory
    {
        return GradeFactory::new();
    }
}
