<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\User;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new User();
        $user->insert([
            'name' => 'Kato',
            'email' => 'admin@mail.com',
            'password' => password_hash('123456', PASSWORD_BCRYPT),
            'role' => 1
        ]);

        for ($i = 0; $i < 100; $i++) {
            $faker = Factory::create('id_ID');
            $data = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => password_hash('123456', PASSWORD_BCRYPT),
                'role' => 2
            ];
            
            $user->insert($data);
        }
    }
}