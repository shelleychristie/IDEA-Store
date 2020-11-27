<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Users')->insert([
            [
                'email' => 'test1@mail.com',
                'password' => Hash::make('a12345678'),
                'role' => 'Member',
            ],
            [
                'email' => 'admin1@mail.com',
                'password' => Hash::make('a12345678'),
                'role' => 'Admin',
            ],
        ]);
    }
}
