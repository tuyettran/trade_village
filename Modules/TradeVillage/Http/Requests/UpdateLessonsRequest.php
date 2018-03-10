<?php

namespace Modules\Tradevillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateLessonsRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'course_id' => 'required|integer|min:1',
        ];
    }

    public function translationRules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
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
