<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateProcessRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'step' => 'required|integer|min:1',
            'process-image' => 'file|image',
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
