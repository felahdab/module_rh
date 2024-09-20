<?php

namespace Modules\RH\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

use Modules\RH\Api\v1\Requests\ApiGetMarinUuidRequest;
use Modules\RH\Api\v1\Requests\StoreMarinRequest;

use Modules\RH\Models\Marin;

/**
 * @tags Module RH: Marin
 */
class MarinController extends Controller
{

     /**
     * Liste des marins
     *
     */
     public function index(Request $request)
     {
          $request->validate([
               /**
                * Le NID du marin recherché
               * @example "0012030028"
               */
               'filter[nid]' => 'string',
          ]);
               
          $users = QueryBuilder::for(Marin::select(["id", "nom", "prenom", "nid"]))
               ->allowedFilters('nid')
               ->get();

          return $users;
     }

     /**
     * Cree un nouveau marin
     *
     */
     public function store(StoreMarinRequest $request)
     {
          $marin = Marin::where('nid', $request->input('nid'))->first();
          
          if ($marin){
               return response("Un marin avec ce NID existe deja", 400);
          }

          Log::info("API: creating marin with : " . json_encode($request->validated(), JSON_PRETTY_PRINT));
          $marin = Marin::create($request->validated());

          return $marin->only(["id", "nom", "prenom", "nid"]);
     }
 
}
