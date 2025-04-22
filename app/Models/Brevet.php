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
	use HasUuids;
/** 
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'libelle_court',
        'libelle_long',
        'ordre',
        'data',
    ];
}

