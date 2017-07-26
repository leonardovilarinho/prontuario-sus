<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceituarioRequest extends FormRequest
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
            'conteudo' => 'required|min:3',
            'paciente_id' => 'required|numeric',
            'autor_id' => 'required|numeric',
        ];
    }
}
