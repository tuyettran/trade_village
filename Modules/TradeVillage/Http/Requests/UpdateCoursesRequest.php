<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateCoursesRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'start_time' => 'required|date',
            'end_time' => 'date|after:start_time',
        ];
    }

    public function translationRules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'author' => 'required',
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
