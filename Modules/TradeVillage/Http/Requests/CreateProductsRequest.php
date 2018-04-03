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
            'category_id' => 'required|integer|min:1',
        ];
    }

    public function translationRules()
    {
        return [
            'name' => 'required|max:100',
            'description' => 'required|max:256',
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
