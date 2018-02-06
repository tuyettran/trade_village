<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateProcessRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'step' => 'required|integer|min:1',
        ];
    }

    public function translationRules()
    {
        return [
            'description' => 'required',
            'title' => 'required|max:100',
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
