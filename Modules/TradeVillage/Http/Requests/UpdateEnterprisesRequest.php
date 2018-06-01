<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateEnterprisesRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'village_id' => 'required|integer|min:1',
            'contact' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ];
    }

    public function translationRules()
    {
        return [
            'description' => 'required|max:256',
            'name' => 'required',
            'detail' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
