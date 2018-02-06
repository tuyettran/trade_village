<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateEventsRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'village_id' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'end_time' => 'date|after:start_time',
        ];
    }

    public function translationRules()
    {
        return [
            'title' => 'required|max:100',
            'content' => 'required',
            'address' => 'required',
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
