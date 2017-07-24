<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory(App\Model\Administrador::class, 5)->create();

        factory(App\Model\CargaHoraria::class, 35)->create();

        factory(App\Model\NaoMedico::class, 22)->create();

        factory(App\Model\Secretario::class, 12)->create();

        factory(App\Model\Paciente::class, 121)->create();
    }
}
