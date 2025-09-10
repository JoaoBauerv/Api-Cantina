<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('nm_usuario', 'TESTE')->first()){
            User::create([
                'nm_usuario' => 'TESTE',
                'senha' => Hash::make('123456', ['rounds' => 12]),
                'fl_permissao' => true,
            ]);
        }
    }
}
