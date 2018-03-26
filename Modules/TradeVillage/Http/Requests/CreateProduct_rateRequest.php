<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateProduct_rateRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'product_id' => 'required|integer|min:1',
            'value' => 'required|integer|min:1|max:5',
            'user_id' => 'required|min:1',
        ];
    }

    public function translationRules()
    {
        return [];
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
