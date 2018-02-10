<?php
namespace Modules\TradeVillage\Http\Requests;

use Carbon\Carbon;
use Modules\Core\Internationalisation\BaseFormRequest;

class CreateArtistRequest extends BaseFormRequest
{
    public function rules()
    {
        $before_date = Carbon::now()->subYears(18)->toDateString();
        return [
            'date_of_birth' => 'required|date|before:'.$before_date,
            'village_id' => 'required|integer|min:1',
            'user_id' => 'integer|min:1',
            'contact' => 'required'
        ];
    }

    public function translationRules()
    {
        return [
            'name' => 'required|max:100',
            'description' => 'required',
            'detail' => 'required',
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
