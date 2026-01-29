<?php

namespace Modules\RH\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

use App\Models\User as BaseModel;

use Modules\RH\Models\Marin;

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

	/**
	 * Cette méthode est indiquée comme étant private car on veut garantir qu'un utilisateur 
	 * n'a qu'une seule unité à chaque instant. Mais comme les scopes sont appliqués depuis
	 * des classes extérieures au modèle, la méthode ne peut pas être vraiment private.
	 * On change donc simplement son nom comme un avertissement au développeur.
	 */
	public function unite_private()
	{
		return $this->belongsToMany(Unite::class, "rh_user_unite");
	}

	/** 
	 * Les méthodes ci-dessous sont celles à utiliser pour associer une unité à un utilisateur.
	 */
	public function setUnite(?Unite $unite)
	{
		$this->unite_private()->sync($unite, detaching: true);
	}

	public function getUnite()
	{
		return $this->unite;
	}

	public function getUniteAttribute()
	{
		return $this->unite_private()->first();
	}

	/**
	 * Et quelques scopes pour faciliter le filtrage
	 */
	#[Scope]
	protected function deUnite(Builder $query, Unite $unite)
	{
		$query->whereIn('id', $unite->users->pluck('id'));
	}

}
