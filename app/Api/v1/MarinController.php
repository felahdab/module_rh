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

          $marin = Marin::create($request->validated());

          return $marin->only(["id", "nom", "prenom", "nid"]);
     }

     public function get_marin_uuid(ApiGetMarinUuidRequest $request)
     {
     $marin = null;

     if ($request->has('email')){
          $marin = Marin::select(["id", "nom", "prenom", "nid"])
                    ->where('email', $request->input('email'))->get();
     }
     elseif ($request->has('nid')){
          $marin = Marin::select(["id", "nom", "prenom", "nid"])
                    ->where('nid', $request->input('nid'))->get();
     }

     if ($marin != null)
     {
          return $marin;
     }

     return response("marin non trouve", 400);
     }

 
}
