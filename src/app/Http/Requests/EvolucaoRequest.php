<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvolucaoRequest extends FormRequest
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
            'evolucao' => 'required|min:3',
            'diagnostico' => 'nullable|min:3',
            'cid' => 'nullable|max:100',
            'paciente_id' => 'required|numeric',
            'autor_id' => 'required|numeric',
        ];
    }
}
