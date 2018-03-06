<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateNewsRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'village_id' => 'required|integer|min:1',
        ];
    }

    public function translationRules()
    {
        return [
            'title' => 'required',
            'content' => 'required',
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
