<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
        'name' => 'Matchya Skin Serum',
        'description' => 'Mencerahkan dan melembapkan kulit',
        'price' => 199000,
        'image' => null,
        'ingredients' => 'green tea, hyaluronic acid',
        'skin_type' => 'dry',
        'seller_id' => 2, // sesuaikan ID seller
    ]);
    }
}
