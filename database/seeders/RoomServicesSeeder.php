<?php

namespace Database\Seeders;

use App\Models\RoomServices;
use Illuminate\Database\Seeder;

class RoomServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       RoomServices::factory(30)->create();
    }
}
