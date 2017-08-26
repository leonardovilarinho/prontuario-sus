<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultaRequest extends FormRequest
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
            'horario' => 'required|date_format:Y-m-d H:i',
            'paciente_id' => 'required|numeric',
            'usuario_id' => 'required|numeric',
            'status' => 'required',
            'obs' => 'nullable',
            'valor' => 'nullable|min:0',
        ];
    }
}
