<?php

use Illuminate\Database\Seeder;
use App\Model\Usuario;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'login' => 'test',
            'senha' => md5('test'),
            'email' => 'email',
            'active' => true
        ]);
    }
}
