<?php

namespace Modules\RH\Listeners;

use Exception;
use App\Events\RabbitMQMessageReceivedEvent;
use App\Service\RabbitMQService;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Modules\RH\Enums\RabbitMQMessages;
use Modules\RH\Models\Unite;

class UniteDefinitionListener
{
    public function handle(RabbitMQMessageReceivedEvent $event): void
    {
        try {
            $message = $event->message;
            $sourceNode = $event->sourceNode();

            $body = $message->getBody();
            $routingKey = $message->getRoutingKey();
            logger()->info($routingKey);

            if (! Str::endsWith($routingKey, RabbitMQMessages::RH_UNITE_DEFINITION->value))
            {
                return;
            }
            
            logger()->info("Received definition unite from {$sourceNode}");

            $request_id = "no message id in request";
            if ($message->has('message_id')){
                $request_id = $message->get('message_id');
            }

            $timestamp = 0;
            if ($message->has('timestamp')){
                $timestamp = $message->get('timestamp');
            }

            $unite_definition = json_decode($body, true);

            $unite_locale = Unite::where('uuid', $unite_definition["uuid"])->first();
            if ($unite_locale != null)
            {
                logger()->info("Updating unite { $unite_locale } with { $body }");
                $unite_locale->update($unite_definition);
            }
            else
            {
                $unite_locale = Unite::create($unite_definition);
                logger()->info("Created unite locale: {$unite_locale}.");
            }
            
        } catch (Exception $e) {
            logger()->error("Erreur lors du traitement du message RabbitMQ : " . $e->getMessage());
        }
    }
}
