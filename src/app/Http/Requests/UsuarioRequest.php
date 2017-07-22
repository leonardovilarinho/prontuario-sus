<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'nome' => 'max:200|min:3|required',
            'email' => 'max:200|email|required',
            'cpf' => 'max:11|min:11|required',
            'nascimento' => 'max:200|min:3|required|older:18',
            'senha' => 'max:20|min:6|required|confirmed',
        ];
    }
}
