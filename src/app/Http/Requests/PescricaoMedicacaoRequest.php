<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PescricaoMedicacaoRequest extends FormRequest
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
            'prescricao_id' => 'required|numeric',
            'medicacao_id' => 'required|numeric',
            'dose' => 'required|min:1',
            'intervalo' => 'required|numeric',
            'tempo' => 'required|numeric',
        ];
    }
}
