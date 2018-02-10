<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateProductsRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'cost' => 'required',
            'visitor_counter' => 'integer|min:0',
        ];
    }

    public function translationRules()
    {
        return [
            'name' => 'required|max:100',
            'description' => 'required',
            'material' => 'required',
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
