<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateVideoRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'link' => 'required',
            'chapter' => 'required|integer|min:1',
            'lesson_id' => 'required|integer|min:1',
        ];
    }

    public function translationRules()
    {
        return [
            'author' => 'required',
            'name' => 'required|max:100',
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
