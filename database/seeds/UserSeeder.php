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
                'name' => 'testUser1',
                'email' => 'test1@mail.com',
                'password' => Hash::make('a12345678'),
                'address' => 'Gardenia 9 blok A13',
                'gender' => 'Male',
                'date-of-birth' => '1980-03-19',
                'role' => 'Member',
            ],
            [
                'name' => 'admin1',
                'email' => 'admin1@mail.com',
                'password' => Hash::make('a12345678'),
                'address' => 'admins address',
                'gender' => 'Female',
                'date-of-birth' => '1983-05-22',
                'role' => 'Admin',
            ],
        ]);
    }
}
