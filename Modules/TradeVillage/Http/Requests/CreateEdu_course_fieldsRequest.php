<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateEdu_course_fieldsRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'course_id' => 'required|integer|min:1',
            'edu_field_id' => 'required|integer|min:1',
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
