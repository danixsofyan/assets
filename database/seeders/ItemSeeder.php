<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'name'          => 'Whiteboard',
            'category_id'   => 1,
            'status_id'     => 1,
            'location_id'   => 1,
            'description'   => 'Good',
            'photo'         => 'belum ada foto',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        Item::create([
            'name'          => 'iPad Pro',
            'category_id'   => 2,
            'status_id'     => 2,
            'location_id'   => 2,
            'description'   => 'LCD Rusak',
            'photo'         => 'belum ada foto',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        Item::create([
            'name'          => 'Meja Kerja',
            'category_id'   => 3,
            'status_id'     => 3,
            'location_id'   => 3,
            'description'   => 'Baud ilang',
            'photo'         => 'belum ada foto',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        Item::create([
            'name'          => 'Mobil Operational',
            'category_id'   => 4,
            'status_id'     => 1,
            'location_id'   => 4,
            'description'   => 'Lecet dikit',
            'photo'         => 'belum ada foto',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
