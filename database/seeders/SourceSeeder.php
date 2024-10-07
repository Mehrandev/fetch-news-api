<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define initial sources
        $sources = [
            ['name' => 'NewsAPI']
        ];

        // Insert sources into the database
        DB::table('sources')->insertOrIgnore($sources);
    }
}
