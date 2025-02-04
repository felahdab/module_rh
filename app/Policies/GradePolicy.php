<?php

namespace Modules\RH\Policies;

use App\Policies\GenericSkeletorPolicy;

use App\Models\User;
use App\Models\Remotesystem;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class GradePolicy extends GenericSkeletorPolicy
{
   protected $slug='rh::grades';

}
