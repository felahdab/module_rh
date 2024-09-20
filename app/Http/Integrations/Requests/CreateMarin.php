<?php

namespace Modules\RH\Http\Integrations\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

class CreateMarin extends Request implements HasBody
{
    use HasJsonBody;
    protected Method $method = Method::POST;

    public function __construct(public string $id, 
                                public string $nom,
                                public string $prenom,
                                public string $nid) 
    {
    }

    public function resolveEndpoint(): string
    {
        return '/api/rh/v1/marin';
    }

    protected function defaultBody(): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'nid' => $this->nid,
        ];
    }
}