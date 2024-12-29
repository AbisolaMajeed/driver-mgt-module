<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = array([
            'name' => 'Kola Ajayi',
            'email' => 'ajayi@yahoo.com',
            'role' => 'super_admin'
        ],
        [
            'name' => 'Tiwa Ajayi',
            'email' => 'tiwaajayi@gmail.com',
            'role' => 'admin'
        ],
        [
            'name' => 'Ifeanyi Chuka',
            'email' => 'ifeanyi@gmail.com',
            'role' => 'support_staff'
        ]);

        for ($i = 0; $i < count($users); $i++) {
            User::updateOrCreate(["email" => $users[$i]],
            [
                'name' => $users[$i]['name'],
                'email' => $users[$i]['email'],
                'role' => $users[$i]['role'],
                'password' => bcrypt('password')
            ]);
        }
    }
}
