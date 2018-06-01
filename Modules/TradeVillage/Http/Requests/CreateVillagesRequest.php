<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateVillagesRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'category_id' => 'required|integer|min:1',
            'visitor_counter' => 'required|integer',
            'district' => 'required',
            'province' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ];
    }

    public function translationRules()
    {
        return [
            'name' => 'required',
            'description' => 'required|max:255',
            'story' => 'required',
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
