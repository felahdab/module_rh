<?php

namespace Modules\RH\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Modules\RH\Traits\HasTablePrefix;

use Modules\RH\Models\Marin;
use Modules\RH\Models\Mpe ;

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
		'code_sirh_unite',
		'id_mere',
	];
	
	public function marins()
	{
		return $this->hasMany(Marin::class, 'unite_id', 'id');
	}

	// Liaison Categorie Mere Fille dans table Unite
	public function parent()
	{
		return $this->belongsTo(Unite::class,'id_mere');
	}

	public function children()
	{
		return $this->hasMany(Unite::class,'id_mere');
	}

	// Liaison entre TypeUnite et Unite
	public function typeUnite()
    {
        return $this->belongsTo(TypeUnite::class, "type_unite_id", "id");
    }


	public function mpe()
	{
		return $this->hasMany(Mpe::class,'unite_id');
	}

}
