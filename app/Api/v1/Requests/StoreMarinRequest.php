<?php

namespace Modules\RH\Api\v1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarinRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "id"      => "string|required",
            "nom"     => "string|required",
            "prenom"  => "string|required",
            "nid"     => "string|required",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
