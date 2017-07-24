<?php

namespace App\Http\Requests ;

use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
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
            'nome' => 'required|min:3|max:150',
            'prontuario' => 'required',
            'leito' => 'nullable',
            'nascimento' => 'required|date',
            'convenio' => 'required|max:40',
            'num_convenio' => 'nullable|max:50',
            'sexo' => 'required',
            'civil' => 'required',
            'cor' => 'required',
            'naturalidade' => 'required|max:30',
            'grau' => 'nullable|max:80',
            'cpf' => 'nullable|min:11|max:11',
            'profissao' => 'nullable|max:50',
            'email' => 'nullable|email|max150',
            'telefone' => 'nullable|max:15|min:8',
            'endereco' => 'nullable|max:150',
            'bairro' => 'nullable|max:50',
            'cidade' => 'nullable|max:50',
            'cep' => 'nullable|max:10',
            'uf' => 'nullable:max:2',
            'obs' => 'nullable',
        ];
    }
}
