<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            [
                'name' => 'Sofas',
                'image' => 'productTypes/sofa.jpeg',
            ],
            [
                'name' => 'Bookshelves',
                'image' => 'productTypes/bookshelf.jpeg'
            ],
        ]);
    }
}
