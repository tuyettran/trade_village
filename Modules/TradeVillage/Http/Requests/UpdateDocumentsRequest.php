<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateDocumentsRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'chapter' => 'required|integer|min:1',
            'lesson_id' => 'required',
        ];
    }

    public function translationRules()
    {
        return [
            'title' => 'required|max:100',
            'author' => 'required',
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
