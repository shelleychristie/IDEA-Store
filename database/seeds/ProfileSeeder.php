<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Profiles')->insert([
            [
                'user_id' => 1,
                'name' => 'testUser1',
                'address' => 'Gardenia 9 blok A13',
                'gender' => 'Male',
                'date_of_birth' => '1980-03-19',
            ],

        ]);
    }
}
