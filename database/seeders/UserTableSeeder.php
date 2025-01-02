<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'fullname' => 'Matheus Tavares Borges dos Santos',
                'nickname' => 'MatLoneKnight',
                'password' => Hash::make('123456'),
                'email' => 'mat@gmail.com',
                'birthdate' => '2000-01-01',
            ]
        ];

        $addresses = [
            [
                'user_id' => 1,
                'state_id' => 24,
                'zipcode' => '15454544',
                'street' => 'Rua 1',
                'number' => '123',
                'neighborhood' => 'Bairro 1',
                'city' => 'Cidade 1',
            ]
        ];

        $libraries = [
            [
                'user_id' => 1,
                'name' => 'Beaten Games',
                'description' => 'A collection of games I have beaten',
                'is_main' => 1,
            ]
        ];

        foreach ($users as $user) {
            $user = \App\Models\User::create($user);
            $user->addresses()->create($addresses[0]);
            $user->libraries()->create($libraries[0]);
        }
    }
}
