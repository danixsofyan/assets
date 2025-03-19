<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name'          => 'Baik',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        Status::create([
            'name'          => 'Rusak',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        Status::create([
            'name'          => 'Perlu Perbaikan',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
