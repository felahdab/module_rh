<?php

namespace Modules\RH\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\RH\Traits\HasTablePrefix;

class Personne
{
    use HasUuids; 
    use HasTablePrefix;

    protected $primaryKey = 'uuid';

    protected $table='users';
}
