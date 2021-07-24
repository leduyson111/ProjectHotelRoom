<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\RoomServices;
use App\Models\Services;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomServicesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoomServices::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_id'=>Room::all()->random()->id,
            'service_id'=>Services::all()->random()->id,
            'additional_price' => rand(1,200)
        ];
    }
}
