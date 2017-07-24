<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargaHorariaRequest extends FormRequest
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
            'intervalo' => 'required|numeric|min:1|max:59',
            'inicio' => 'required|date_format:H:i',
            'fim' => 'required|date_format:H:i',
        ];
    }
}
