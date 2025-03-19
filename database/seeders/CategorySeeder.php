<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'          => 'Alat tulis kantor',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        Category::create([
            'name'          => 'Elektronik',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        Category::create([
            'name'          => 'Meubel',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        Category::create([
            'name'          => 'Kendaraan',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
