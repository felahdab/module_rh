<?php

namespace Modules\RH\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\RH\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Model;


class Marin extends Model
{
    use HasUuids; 
    use HasTablePrefix;
}
