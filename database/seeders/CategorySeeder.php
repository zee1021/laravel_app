<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Cars', 'Appliances', 'Computers', 'Clothes', 'Furniture'];

        foreach ($categories as $catName) {
            Category::firstOrCreate(['name' => $catName]);
        }
    }
}