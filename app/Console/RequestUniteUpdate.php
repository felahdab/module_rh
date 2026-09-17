<?php

namespace Modules\RH\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Modules\RH\Models\Unite;
use Modules\RH\Enums\RabbitMQMessages;

use App\Service\RabbitMQService;

class RequestUniteUpdate extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $name = 'rh:request_unite_update';

    /**
     * The console command description.
     */
    protected $description = 'Demande la mise à jour de la table des unités à l instance distante, si cette instance est définie.';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $instance_distante = config("rh.instance_de_reference_unites");

        if ( $forced_instance_distante = Arr::get($this->arguments('remote'), "remote"))
        {
            $this->info("Instance de mise à jour forcée manuellement: {$forced_instance_distante}");
            $instance_distante = $forced_instance_distante;
        }

        $liste_des_unites_locales = Unite::pluck('libelle_long', 'uuid')->all();

        $request_message = RabbitMQService::makeMessage($liste_des_unites_locales);
        RabbitMQService::publishMessage($request_message, $instance_distante, RabbitMQMessages::RH_REQUEST_UNITES_UPDATE->value);
        
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['remote', InputArgument::OPTIONAL, 'Instance distante à interroger'],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
        ];
    }
}
