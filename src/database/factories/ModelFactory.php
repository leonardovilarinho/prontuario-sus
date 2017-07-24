<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Model\Usuario::class, function (Faker\Generator $faker) {

	$faker->addProvider(new Faker\Provider\pt_BR\Person($faker));

    return [
    	'nome' => $faker->name,
    	'email' => $faker->unique()->safeEmail,
    	'cpf' => $faker->cpf(false),
    	'nascimento' => $faker->date(),
    	'senha' => bcrypt('secret'),
    ];
});


$factory->define(App\Model\Administrador::class, function (Faker\Generator $faker) {
    return [
    	'usuario_id' => factory(App\Model\Usuario::class)->create()->id,
    ];
});

$factory->define(App\Model\Medico::class, function (Faker\Generator $faker) {

	$faker->addProvider(new Faker\Provider\pt_BR\PhoneNumber($faker));
	$faker->addProvider(new Faker\Provider\en_US\Person($faker));

    return [
    	'usuario_id' => factory(App\Model\Usuario::class)->create()->id,
    	'conselho' => 'MG' . $faker->randomNumber('7') ,
        'especialidade' => $faker->lastName(),
        'cargo' => $faker->lastName(),
        'telefone' => $faker->cellphone(false),
        'ferias' => $faker->numberBetween(0, 1)
    ];
});

$factory->define(App\Model\CargaHoraria::class, function (Faker\Generator $faker) {

	$faker->addProvider(new Faker\Provider\pt_BR\PhoneNumber($faker));
	$faker->addProvider(new Faker\Provider\en_US\Person($faker));

    return [
    	'medico_id' => factory(App\Model\Medico::class)->create()->usuario_id,
    	'intervalo' => $faker->numberBetween(0, 59),
        'inicio' => $faker->time('H:i'),
        'fim' => $faker->time('H:i'),
    ];
});

$factory->define(App\Model\NaoMedico::class, function (Faker\Generator $faker) {

	$faker->addProvider(new Faker\Provider\pt_BR\PhoneNumber($faker));
	$faker->addProvider(new Faker\Provider\en_US\Person($faker));

    return [
    	'usuario_id' => factory(App\Model\Usuario::class)->create()->id,
    	'conselho' => 'MG' . $faker->randomNumber(7) ,
        'especialidade' => $faker->lastName(),
        'cargo' => $faker->lastName(),
        'telefone' => $faker->cellphone(false),
    ];
});


$factory->define(App\Model\Secretario::class, function (Faker\Generator $faker) {

	$faker->addProvider(new Faker\Provider\pt_BR\PhoneNumber($faker));
	$faker->addProvider(new Faker\Provider\en_US\Person($faker));

    return [
    	'usuario_id' => factory(App\Model\Usuario::class)->create()->id,
        'cargo' => $faker->lastName(),
        'telefone' => $faker->cellphone(false),
    ];
});

$factory->define(App\Model\Paciente::class, function (Faker\Generator $faker) {

	$faker->addProvider(new Faker\Provider\pt_BR\PhoneNumber($faker));
	$faker->addProvider(new Faker\Provider\en_US\Person($faker));
	$faker->addProvider(new Faker\Provider\en_US\Address($faker));

	$sexo = ['Masculino', 'Feminino'];
	$civil = ['Solteiro', 'Divorciado', 'Casado', 'Viúvo', 'Separado'];
	$cor = ['Preta', 'Branca', 'Parda', 'Indigena', 'Amarela', 'Não declarado'];

    return [
    	'nome' => $faker->name,
    	'prontuario' => time(),
    	'leito' => $faker->randomDigitNotNull(),
    	'nascimento' => $faker->date(),
    	'convenio' => $faker->lastName(),
    	'num_convenio' => $faker->randomNumber(8),
    	'sexo' => $sexo[ array_rand($sexo) ],
    	'civil' => $civil[ array_rand($civil) ],
    	'cor' => $cor[ array_rand($cor) ],
    	'naturalidade' => $faker->lastName(),
    	'grau' => $faker->lastName(),
    	'cpf' => $faker->cpf(false),
    	'profissao' => $faker->lastName(),
    	'email' => $faker->unique()->safeEmail,
    	'telefone' => $faker->cellphone(false),
    	'endereco' => $faker->address(),
    	'bairro' => $faker->streetName(),
    	'cidade' => $faker->city(),
    	'cep' => $faker->postcode(),
    	'uf' => $faker->stateAbbr(),
    	'obs' => $faker->text() 
    ];
});
