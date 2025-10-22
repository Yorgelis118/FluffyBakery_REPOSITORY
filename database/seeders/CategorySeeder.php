<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Pasteles', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cupcakes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Galletas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rellenos', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Brownies', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alfajores', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
