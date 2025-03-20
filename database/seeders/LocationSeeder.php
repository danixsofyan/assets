<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'branch_name'   => 'Bandung',
            'building_name' => 'Graha',
            'floor'         => 1,
            'room'          => 'Kepala Bagian',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        Location::create([
            'branch_name'   => 'Bandung',
            'building_name' => 'Graha',
            'floor'         => 2,
            'room'          => 'Divisi IT',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        Location::create([
            'branch_name'   => 'Jakarta',
            'building_name' => 'Menara',
            'floor'         => 1,
            'room'          => 'Divisi Legal',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        Location::create([
            'branch_name'   => 'Surabaya',
            'building_name' => 'Towe',
            'floor'         => 2,
            'room'          => 'Divisi Finance',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
