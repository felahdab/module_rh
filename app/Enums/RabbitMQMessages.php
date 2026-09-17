<?php

namespace Modules\RH\Enums;

enum RabbitMQMessages: string
{
    case RH_REQUEST_UNITES_UPDATE = "rh.request_unites_update";
    case RH_REQUEST_UNITES_UPDATE_RESPONSE = "rh.request_unites_update_response";
    case RH_UNITE_DEFINITION = "rh.unite_definition";
    case RH_REQUEST_GRADES_UPDATE = "rh.request_grades_update";
    case RH_REQUEST_BREVETS_UPDATE = "rh.request_brevets_update";
    case RH_REQUEST_MARINS_UPDATE = "rh.request_marins_update";
}
