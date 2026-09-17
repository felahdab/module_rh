<?php

namespace Modules\RH\Listeners;

use Exception;
use App\Events\RabbitMQMessageReceivedEvent;
use App\Service\RabbitMQService;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Modules\RH\Enums\RabbitMQMessages;
use Modules\RH\Models\Unite;

class RequestUniteUpdateListener
{
    public function handle(RabbitMQMessageReceivedEvent $event): void
    {
        try {
            $message = $event->message;
            $sourceNode = $event->sourceNode();

            $body = $message->getBody();
            $routingKey = $message->getRoutingKey();
            logger()->info($routingKey);

            if (! Str::endsWith($routingKey, RabbitMQMessages::RH_REQUEST_UNITES_UPDATE->value))
            {
                return;
            }
            
            logger()->info("Received  request unites_update from {$sourceNode}");

            $request_id = "no message id in request";
            if ($message->has('message_id')){
                $request_id = $message->get('message_id');
            }

            $timestamp = 0;
            if ($message->has('timestamp')){
                $timestamp = $message->get('timestamp');
            }

            $request_unite_liste = json_decode($body, true);

            $unites_identiques = [];
            $unites_libelle_different = [];
            $unites_inconnues = [];
            $unites_manquantes = [];

            $nb_unites_recues = count($request_unite_liste);
            logger()->info("{$nb_unites_recues} unités dans la liste recue");

            foreach ($request_unite_liste as $unite_uuid => $unite_libelle_long )
            {
                $local_unite = Unite::where("uuid", $unite_uuid)->first();
                if ($local_unite)
                {
                    if ($local_unite->libelle_long == $unite_libelle_long)
                    {
                        $unites_identiques[$unite_uuid] = $unite_libelle_long;
                    }
                    else
                    {
                        $unites_libelle_different[$unite_uuid] = $unite_libelle_long;
                    }
                }
                else {
                    $unites_inconnues[$unite_uuid] = $unite_libelle_long;
                }
            }

            foreach(Unite::pluck("libelle_long", "uuid")->all() as $unite_locale_uuid => $unite_locale_libelle_long)
            {
                $result = Arr::get($request_unite_liste, $unite_locale_uuid);
                if ($result == null )
                {
                    $unites_manquantes[$unite_locale_uuid] = $unite_locale_libelle_long;
                }

            }

            $content = ['unites_identiques' => $unites_identiques,
                        'unites_libelle_different' => $unites_libelle_different,
                        'unites_inconnues' => $unites_inconnues,
                        'unites_manquantes' => $unites_manquantes
            ];

            $message = RabbitMQService::makeMessage($content);
            RabbitMQService::publishMessage($message, destination_node: $sourceNode, routing_key: RabbitMQMessages::RH_REQUEST_UNITES_UPDATE_RESPONSE->value);

            foreach (array_merge($unites_manquantes, $unites_libelle_different) as $unite_a_corriger_uuid => $unite_corriger_libelle_long)
            {
                $unite = Unite::where("uuid", $unite_a_corriger_uuid)->first();
                $definition = Arr::except($unite->toArray(), ["id","data", "code_sirh_unite", "type_unite_id", "lieu_unite_id", "created_at", "updated_at", "id_mere", "ordre"]);

                $unite_message = RabbitMQService::makeMessage($definition);
                RabbitMQService::publishMessage($unite_message, destination_node: $sourceNode, routing_key: RabbitMQMessages::RH_UNITE_DEFINITION->value);
                
            }

        } catch (Exception $e) {
            logger()->error("Erreur lors du traitement du message RabbitMQ : " . $e->getMessage());
        }
    }
}
