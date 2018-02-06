<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateVideoRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'link' => 'required',
            'chapter' => 'required|integer|min:1',
            'course_id' => 'required|integer|min:1',
        ];
    }

    public function translationRules()
    {
        return [
            'author' => 'required',
            'name' => 'required|max:100',
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
