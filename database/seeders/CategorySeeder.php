<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define initial categories
        $categories = [
            ['name' => 'business'],
            ['name' => 'tech']
        ];

        // Insert categories into the database
        DB::table('categories')->insertOrIgnore($categories);
    }
}
