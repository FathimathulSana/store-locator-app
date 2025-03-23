<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stores')->insert([
            [
            'name' => 'Max',
            'address' => 'Vadakara, Railway Station Road, Vadakara, Kozhikode, Kerala, 670109, India',
            'contact' => '845-654-6888',
            'latitude' => 11.5938180,
            'longitude' => 75.5872715,
            'opening_time' => '10:00:00',
            'closing_time' => '22:00:00',
        ],[
            'name' => 'zudio',
            'address' => 'Nadapuram, Vadakara, Kozhikode, Kerala, 673504, India',
            'contact' => '845-654-6888',
            'latitude' => 11.6851867,
            'longitude' => 75.6543660,
            'opening_time' => '10:00:00',
            'closing_time' => '22:00:00',
        ],
        [
            'name' => 'Nesto',
            'address' => 'Deira, Dubai, United Arab Emirates',
            'contact' => '9047713513',
            'latitude' => 25.2727936,
            'longitude' => 55.3053340,
            'opening_time' => '10:00:00',
            'closing_time' => '22:00:00',
        ],
    ]);
    }
}
