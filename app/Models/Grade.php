<?php

namespace Modules\RH\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


use Modules\RH\Traits\HasTablePrefix;

class Grade extends Model
{
    use HasFactory;
	use HasTablePrefix;
	use HasUuids;
	
	public function users()
	{
		return $this->hasMany(User::class);
	}
}
