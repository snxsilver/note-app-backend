<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
// use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('users')->insert([
        //     'uuid' => Uuid::uuid4()->getHex(),
        //     'username' => 'koplo',
        //     'email' => 'koplo@gmail.com',
        //     'password' => Hash::make('Koplo123'),
        // ]);
        User::create([
            'uuid' => Uuid::uuid4()->getHex(),
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('User123'),
        ]);
    }
}
