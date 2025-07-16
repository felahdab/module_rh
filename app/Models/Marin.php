<?php

namespace Modules\RH\Models;

use App\Events\UnUtilisateurLocalDoitEtreCreeEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Modules\RH\Models\User;

use Modules\RH\Traits\HasTablePrefix;
use Modules\RH\Jobs\ConfirmMarinUuidJob;
use Modules\RH\Database\Factories\MarinFactory;

use App\Service\RandomPasswordGeneratorService;
use Modules\RH\Events\UnMarinDoitEtreCreeEvent;

class Marin extends Model
{
    use HasTablePrefix;
    use HasFactory;

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
        'user_id',
        'data',
        'email',
        'display_name',
        'code_sirh_user',
    ];

    protected function casts(): array
    {
        return [
            'data' => AsArrayObject::class,
        ];
    }

    protected static function newFactory(): MarinFactory
    {
        return MarinFactory::new();
    }

    protected static function booted(): void
    {
        static::creating(function (Marin $marin) {
            // Modification de la regle status pour les Tests (pour pouvoir mettre un autre status lors de la creation)
            // $data = ["status" => "pending_uuid_confirmation"];
            // $marin->data = $data;
            if (empty($marin->data)){
                $marin->data = ["status" => "pending_uuid_confirmation"];
            }
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

    public function user()
    {
        return $this->belongsTo(User::class);
        //return $this->hasOne(User::class);
    }

    public function setUser(?User $user, bool $dissociate_others = true)
    {

        $user_id = $user ? $user->id : null;

        if ($user_id != null && $dissociate_others)
        {
            static::where("user_id", $user_id)
                ->get()
                ->each(function(Marin $marin){
                    $marin->setUser(null);
                });
        }

        $this->user_id = $user_id;
        $this->save();
    }

    public function getUser()
    {
        return $this->user;
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

    /////////////
    // JULIEN  //
    /////////////

    /**
     * Accessor pour nom complet
     * @return string
     */
    public function getFullNameAndGradeAttribute()
    {
        $gradeName = $this->grade?->libelle_court ??'N/A';
        return $this->nom.' '.$this->prenom.' ('.$gradeName.')';
    }

    /**
     *  Trouver un marin par NID ou creer un nouveau si il existe pas
     * 
     *  Function qui cherche un Marin par NID pour les TESTS car champ UNIQUE
     *  Si il trouve, il reprend ce marin
     *  SI il trouve pas, il le cree
     * 
     * @param string $nid Le NID pour trouver Marin
     * @param array $data les champ pour specifier la creation
     * @return \Modules\RH\Models\Marin Cherche ou creer dans RH_Marin
     */
    public static function findOrCreateByNid(string $nid, array $data  ){
        $attributes = ['nid' => $nid ];

        $values = [];
        if(!empty($data['data'])){
            $values['data']=json_encode($data['data']);
        }else{
            $values['prenom']=json_encode(['status' => 'pending_uuid_confirmation']);
        }

        $values['uuid']     = $data['uuid'] ?? 'UUID Test';
        $values['prenom']   = $data['prenom'] ?? 'Prenom Test';
        $values['nom']      = $data['nom'] ?? 'Nom Test';

        return self::firstOrCreate($attributes,$values);
        
    }


    /**
     *  Creer un User
     * 
     *  Function qui cree un user similaire a RH_marins
     * 
     * @return \Modules\RH\Models\Marin Creation User de Marin
     */
    public  function createUser()
    {
        // User existe deja
        if ($this->user){
            return null;
        }

        $user = User::create([
            'nom'   =>$this->nom,
            'prenom'=>$this->prenom,
            'email' =>$this->email,
            'password'=>RandomPasswordGeneratorService::generateRandomString(10),

        ]);

        $this->user()->associate($user);
        $this->save();

        return $user;
    }

    
    
}
