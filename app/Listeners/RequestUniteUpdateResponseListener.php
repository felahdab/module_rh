<?php

namespace Modules\RH\Listeners;

use Exception;
use App\Events\RabbitMQMessageReceivedEvent;
use App\Service\RabbitMQService;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Modules\RH\Enums\RabbitMQMessages;
use Modules\RH\Models\Unite;

class RequestUniteUpdateResponseListener
{
    public function handle(RabbitMQMessageReceivedEvent $event): void
    {
        try {
            $message = $event->message;
            $sourceNode = $event->sourceNode();

            $body = $message->getBody();
            $routingKey = $message->getRoutingKey();
            logger()->info($routingKey);

            if (! Str::endsWith($routingKey, RabbitMQMessages::RH_REQUEST_UNITES_UPDATE_RESPONSE->value))
            {
                return;
            }
            
            logger()->info("Received unites_update_response from {$sourceNode}");

            $request_id = "no message id in request";
            if ($message->has('message_id')){
                $request_id = $message->get('message_id');
            }

            $timestamp = 0;
            if ($message->has('timestamp')){
                $timestamp = $message->get('timestamp');
            }

            $response = json_decode($body, true);

            $unites_identiques = Arr::get($response, "unites_identiques", []);
            $unites_libelle_different = Arr::get($response, "unites_libelle_different", []);
            $unites_inconnues = Arr::get($response, "unites_inconnues", []);
            $unites_manquantes = Arr::get($response, "unites_manquantes", []);


        } catch (Exception $e) {
            logger()->error("Erreur lors du traitement du message RabbitMQ : " . $e->getMessage());
        }
    }
}
