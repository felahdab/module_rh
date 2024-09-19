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
        $marin = Marin::find($this->uuid);

        $settings = Setting::forKey('rh');
        $active = $settings->get('use_remote_rh_server');
        if (!$active)
        {
            return ;
        }
        $url = $settings->get('url_of_remote_rh_instance');
        $token = $settings->get('token_for_remote_rh_instance');
        
        $server = new CentralRHServerConnector($url, $token);
        $request = new RetreiveMarinByNID($marin->nid);

        $response = $server->send($request);

        if ($response->successful())
        {
            $json = $response->json();
            $uuid = $json["id"];
            $marin->uuid = $uuid;
            $data = $marin->data;
            Arr::set($data, "status", "uuid_confirmed");
            $marin->data = $data;
            $marin->save();
            return;
        }
        
        return $response->throw();

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
