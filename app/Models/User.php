<?php

namespace Modules\RH\Models;

use Modules\RH\Models\Marin;
use App\Models\User as BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends BaseModel
{
	use HasFactory;

	protected  static function newFactory()
	{
		return \Modules\RH\Database\Factories\UserFactory::new();
	}

	public function marin()
	{
		return $this->hasOne(Marin::class);
	}
}
