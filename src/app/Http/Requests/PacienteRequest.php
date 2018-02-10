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
            'foto' => 'nullable|max:100|image',
            'nome' => 'required|min:3|max:150',
            'prontuario' => 'required',
            'leito' => 'nullable',
            'nascimento' => 'required|date',
            'convenio' => 'required|max:40',
            'num_convenio' => 'nullable|max:50',
            'sexo' => 'nullable',
            'civil' => 'nullable',
            'cor' => 'nullable',
            'naturalidade' => 'nullable|max:30',
            'grau' => 'nullable|max:80',
            'cpf' => 'nullable|min:11|max:11',
            'profissao' => 'nullable|max:50',
            'email' => 'nullable|email|max:150',
            'telefone' => 'nullable|min:3|max:255',
            'endereco' => 'nullable|max:150',
            'bairro' => 'nullable|max:50',
            'cidade' => 'nullable|max:50',
            'cep' => 'nullable|max:10',
            'uf' => 'nullable|max:2',
            'obs' => 'nullable',
        ];
    }
}
