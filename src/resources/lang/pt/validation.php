<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | O campo \'following \'language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'O campo \':attribute\' deve ser aceito.',
    'active_url'           => 'O campo \':attribute\' não é uma URL válida.',
    'after'                => 'O campo \':attribute\' deve ser uma data após :date.',
    'after_or_equal'       => 'O campo \':attribute\' deve ser uma data após ou igual a :date.',
    'alpha'                => 'O campo \':attribute\' só pode conter letras.',
    'alpha_dash'           => 'O campo \':attribute\' só pode conter letras, números e traços.',
    'alpha_num'            => 'O campo \':attribute\' só pode conter letras e números.',
    'array'                => 'O campo \':attribute\' deve ser uma lista.',
    'before'               => 'O campo \':attribute\' deve ser uma data antes de :date.',
    'before_or_equal'      => 'O campo \':attribute\' deve ser uma data antes ou igual a :date.',
    'between'              => [
        'numeric' => 'O campo \':attribute\' deve estar entre :min e :max.',
        'file'    => 'O campo \':attribute\' ter um tamanho entre :min e :max kilobytes.',
        'string'  => 'O campo \':attribute\' deve ter entre :min e :max caracteres.',
        'array'   => 'O campo \':attribute\' deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'O campo \':attribute\' deve ser verdadeiro ou falso.',
    'confirmed'            => 'O campo \':attribute\' não foi confirmado.',
    'date'                 => 'O campo \':attribute\' não é uma data válida.',
    'date_format'          => 'O campo \':attribute\' não tem o formato :format.',
    'different'            => 'Os campos \':attribute\' e \':other\' devem ser direferentes.',
    'digits'               => 'O campo \':attribute\' deve ter :digits dígitos.',
    'digits_between'       => 'O campo \':attribute\' must be between :min and :max digits.',
    'dimensions'           => 'O campo \':attribute\' possui uma imagem de dimensão inválida.',
    'distinct'             => 'O campo \':attribute\' tem um valor duplicado.',
    'email'                => 'O campo \':attribute\' deve ser um email válido.',
    'exists'               => 'O campo \'selected :\' tem um valor inválido.',
    'file'                 => 'O campo \':attribute\' deve ser um arquivo.',
    'filled'               => 'O campo \':attribute\' deve ter um valor.',
    'image'                => 'O campo \':attribute\' deve ser uma imagem.',
    'in'                   => 'O campo \'selected :\' tem um valor inválido.',
    'in_array'             => 'O campo \':attribute\' não existe no campo \':other\'.',
    'integer'              => 'O campo \':attribute\' deve ser um número inteiro.',
    'ip'                   => 'O campo \':attribute\' deve ser um endereço de IP válido.',
    'json'                 => 'O campo \':attribute\' deve ser uma string em JSON.',
    'max'                  => [
        'numeric' => 'O campo \':attribute\' não pode ser maior que :max.',
        'file'    => 'O campo \':attribute\' não pode ter mais que :max kilobytes.',
        'string'  => 'O campo \':attribute\' não pode ter mais que :max caracteres.',
        'array'   => 'O campo \':attribute\' não pode ter mais que :max itens.',
    ],
    'mimes'                => 'O campo \':attribute\' deve ser um arquivo do tipo :values.',
    'mimetypes'            => 'O campo \':attribute\'deve ser um arquivo do tipo :values.',
    'min'                  => [
        'numeric' => 'O campo \':attribute\' deve ser pelo menos :min.',
        'file'    => 'O campo \':attribute\' deve ter o tamanho mínimo de :min kilobytes.',
        'string'  => 'O campo \':attribute\' deve ter pelo menos :min caracteres.',
        'array'   => 'O campo \':attribute\' deve ter pelo menos :min itens.',
    ],
    'not_in'               => 'O campo \'selected :\' não é um valor válido.',
    'numeric'              => 'O campo \':attribute\' deve ser um número.',
    'present'              => 'O campo \':attribute\' deve estar presente.',
    'regex'                => 'O campo \':attribute\' não é um Regex válido.',
    'required'             => 'O campo \':attribute\' precisa ser informado.',
    'required_if'          => 'O campo \':attribute\' field is required when :other is :value.',
    'required_unless'      => 'O campo \':attribute\' é obrigatório quanto \':other\' é \':values\'.',
    'required_with'        => 'O campo \':attribute\'  é obrigatório quanto \':values\' está presente.',
    'required_with_all'    => 'O campo \':attribute\' é obrigatório quanto \':values \' está presente.',
    'required_without'     => 'O campo \':attribute\' é obrigatório quanto \':values \' não está presente.',
    'required_without_all' => 'O campo \':attribute\' é obrigatório quanto  \':values \' não está presente.',
    'same'                 => 'O campo \':attribute\' e \':other\' devem ser iguais.',
    'size'                 => [
        'numeric' => 'O campo \':attribute\' deve ser :size.',
        'file'    => 'O campo \':attribute\' deve ser :size kilobytes.',
        'string'  => 'O campo \':attribute\' deve ser :size characters.',
        'array'   => 'O campo \':attribute\' deve conter :size itens.',
    ],
    'string'               => 'O campo \':attribute\' deve ser uma frase.',
    'timezone'             => 'O campo \':attribute\' deve ser uma zona válida.',
    'unique'               => 'O campo \':attribute\' ´já está cadastrado.',
    'uploaded'             => 'O campo \':attribute\' não pode ser carregado.',
    'url'                  => 'O campo \':attribute\' tem um formato inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | O campo \'following \'language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

    'older' => 'Deve ser maior de idade (18 anos)'

];
