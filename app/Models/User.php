<?php

namespace Modules\RH\Models;

use Modules\RH\Models\Marin;
use App\Models\User as BaseModel;

class User extends BaseModel
{
	public function marin()
	{
		return $this->hasOne(Marin::class);
	}
}
