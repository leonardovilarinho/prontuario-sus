<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NaoMedicoRequest extends FormRequest
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
        $usuario = new UsuarioRequest;
    
        return $usuario->rules() + [
            'cargo' => 'nullable|min:3|max:255',
            'especialidade' => 'nullable|min:3|max:255',
            'conselho' => 'nullable|min:3|max:255',
            'telefone' => 'nullable|min:3|max:255',
            'usuario_id' => 'nullable|numeric',
        ];
    }
}
