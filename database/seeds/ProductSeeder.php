<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Kivik',
                'product_type_id' => 1,
                'image' => 'products/sofa1.jpeg',
                'description' => 'Sofa 4 dudukan, dengan chaise longue/Grann/Bomstad hitam',
                'price' => 29990000,
                'stock' => 19,
            ],
            [
                'name' => 'Knopparp',
                'product_type_id' => '1',
                'image' => 'products/sofa2.jpeg',
                'description' => 'Sofa 2 dudukan, Knisa biru terang',
                'price' => '1995000',
                'stock' => '7',
            ],
            [
                'name' => 'BILLY',
                'product_type_id' => '2',
                'image' => 'products/bookshelf1.jpeg',
                'description' => 'Rak buku, putih',
                'price' => '999000',
                'stock' => '26',
            ],
            [
                'name' => 'LOMMARP',
                'product_type_id' => '2',
                'image' => 'products/bookshelf2.jpeg',
                'description' => 'Rak buku, biru gelap-hijau',
                'price' => '2799000',
                'stock' => '13',
            ],
            [
                'name' => 'testing',
                'product_type_id' => '2',
                'image' => null,
                'description' => 'coba kalo ga ada image',
                'price' => '2799000',
                'stock' => '3',
            ],
        ]);
    }
}
