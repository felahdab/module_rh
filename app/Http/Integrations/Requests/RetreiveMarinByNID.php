<?php

namespace Modules\RH\Http\Integrations\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class RetreiveMarinByNID extends Request
{
    protected Method $method = Method::GET;

    public function __construct(public string $nid) {
        $this->query()->add('filter[nid]', $nid);
    }

    public function resolveEndpoint(): string
    {
        return '/api/rh/v1/marins';
    }
}