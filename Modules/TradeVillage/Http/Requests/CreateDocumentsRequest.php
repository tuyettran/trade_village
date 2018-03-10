<?php

namespace Modules\TradeVillage\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateDocumentsRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'chapter' => 'required|integer|min:1',
            'file' => 'required|file|mimes:pdf',
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
