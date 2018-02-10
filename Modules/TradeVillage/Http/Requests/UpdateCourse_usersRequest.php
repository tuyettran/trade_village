<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateCourse_usersRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'user_id' => 'required',
            'chapter' => 'required|integer|min:1',
            'course_id' => 'required',
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
