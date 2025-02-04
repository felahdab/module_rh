<?php

namespace Modules\RH\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

use App\Models\User;

use Modules\RH\Traits\HasTablePrefix;
use Modules\RH\Jobs\ConfirmMarinUuidJob;

class Marin extends Model
{
    use HasTablePrefix;

    protected $fillable = [
        'id',
        'uuid',
        'nom',
        'prenom',
        'matricule',
        'nid',
        'date_embarq',
        'date_debarq',
        'grade_id',
        'specialite_id',
        'brevet_id',
        'unite_id',
        'data',
    ];

    protected function casts(): array
    {
        return [
            'data' => AsArrayObject::class,
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Marin $marin) {
            $data = ["status" => "pending_uuid_confirmation"];
            $marin->data = $data;
        });

        static::created(function (Marin $marin) {   
            $marin->refresh();
            Log::info("Creating marin with uuid: " . $marin->uuid);
            ConfirmMarinUuidJob::dispatch($marin->uuid);
        });
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, "grade_id", "id");
    }

    public function specialite()
    {
        return $this->belongsTo(Specialite::class, "specialite_id", "id");
    }

    public function brevet()
    {
        return $this->belongsTo(Brevet::class, "brevet_id", "id");
    }

    public function unite()
    {
        return $this->belongsTo(Unite::class, "unite_id", "id");
    }

    public function setUser(?User $user)
    {
        $data = $this->data;

        $user_id = $user ? $user->id : null;

        Arr::set($data, "rh.user_id", $user_id);
        $this->data = $data;
        $this->save();
    }

    public function getUser()
    {
        $user_id = Arr::get($this->data, "rh.user_id");
        if ($user_id== null)
            return null;
        $user=User::find($user_id);
        return $user;
    }

    public function isCurrentUser()
    {
        if (! auth()->check())
            return false;
        $user = auth()->user();
        $this_user = $this->getUser();

        if ($this_user && $this_user->id == $user->id)
            return true;

        return false;

    }
}
