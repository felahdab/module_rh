<?php

namespace Modules\RH\Http\Integrations\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class RetreiveMarinUuid extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected readonly string $nid) {
        //
    }

    public function resolveEndpoint(): string
    {
        return '/rh/v1/get_marin_uuid/' . $this->nid;
    }
}