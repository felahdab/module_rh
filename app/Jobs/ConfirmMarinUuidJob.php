<?php

namespace Modules\RH\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Arr;

use App\Jobs\Middleware\RateLimited;
use App\Models\Setting;

use Modules\RH\Http\Integrations\Connectors\CentralRHServerConnector;
use Modules\RH\Http\Integrations\Requests\RetreiveMarinByNID;
use Modules\RH\Models\Marin;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\RH\Http\Integrations\Requests\CreateMarin;

class ConfirmMarinUuidJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $uuid)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::warning("Handling marin uuid retreival :" . $this->uuid . ' ' . tenant()?->id);
        $marin = Marin::where('uuid', $this->uuid)->first();
        if (is_null($marin))
        {
            $this->fail("The provided uuid does not correspond to a valid marin record.");
        }
        //dump($marin->data);

        if (Arr::get($marin->data, "status") == "uuid_confirmed")
        {
            Log::info("UUID is already confirmed. End of job.");
            return;
        }

        $settings = Setting::forKey('rh');
        $active = $settings->get('use_remote_rh_server');
        if (! $active)
        {
            Log::info("Remote uuid confirmation is disabled.");

            $data = $marin->data;
            Arr::set($data, "status", "uuid_confirmed");
            $marin->data = $data;

            $marin->save();
            Log::info("UUID confirmed.");

            return ;
        }

        Log::info("Asking remote RH instance if nid is already known.");

        $url = $settings->get('url_of_remote_rh_instance');
        $token = $settings->get('token_for_remote_rh_instance');
        
        $server = new CentralRHServerConnector($url, $token);
        $request = new RetreiveMarinByNID($marin->nid);
        //dd($request);
        $response = $server->send($request);
        //dd($response->successful());

        if ($response->successful())
        {
            $json = $response->json();

            if (count($json) > 1){
                $this->fail("Le serveur RH distant a renvoyé plusieurs marins avec le même NID.");
            }

            if (count($json) == 0){
                Log::info("The NID is unknown. We will create it.");
                /** Le marin n'existe pas dans la base RH de reference. On va donc le creer. */
                $server = new CentralRHServerConnector($url, $token); 
                $create_request = new CreateMarin( id:     $marin->id, 
                                                   nom:    $marin->nom, 
                                                   prenom: $marin->prenom, 
                                                   nid:    $marin->nid);
                $response = $server->send($create_request);

                $response->throw();
                return;
            }
            
            /**
             * Dans le cas normal, le serveur renvoit uniquement 1 marin. On met à jour la fiche local avec les données
             * distantes. En particulier, on écrase l'uuid pour disposer d'une base d'uuid uniques au sein de l'ensemble des instances.
             */
            Log::info("The NID is known. Updating local entry.");


            $marin_data = $json[0];
            //dump($marin_data);

            $marin->uuid = $marin_data["uuid"];
            $marin->nom = $marin_data["nom"];
            $marin->prenom = $marin_data["prenom"];

            $data = $marin->data;
            Arr::set($data, "status", "uuid_confirmed");
            $marin->data = $data;
            
            $marin->save();
            return;
        }
        
        $this->fail("Le serveur RH distant a répondu avec une erreur.");

    }

        /**
     * Get the middleware the job should pass through.
     *
     * @return array<int, object>
     */
    public function middleware(): array
    {
        return [new RateLimited];
    }
}
