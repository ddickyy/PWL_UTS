<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_user')->insert([
            'level_id' => 1,
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'nama' => 'Samuel Simanjuntak',
            'password' => Hash::make('12345'),
        ]);
    }
}
