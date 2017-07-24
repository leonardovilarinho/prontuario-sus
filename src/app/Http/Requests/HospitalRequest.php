<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sistema' => 'required|min:2:max:12',
            'paginacao' => 'required|numeric|min:1',
            'nome' => 'required|min:2:max:50',
            'local' => 'required|min:2:max:300',
            'logo' => 'nullable|image',
        ];
    }
}
