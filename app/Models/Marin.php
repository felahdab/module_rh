<?php

namespace Modules\RH\Models;

use Modules\RH\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;

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
}
