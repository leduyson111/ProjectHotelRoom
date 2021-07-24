<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_no' => $this->faker->name(),
            'floor' => rand(1,10),
            'image' =>  'https://picsum.photos/640/480',
            'detail'=>$this->faker->paragraph,
            'price' =>rand(1,500),
        ];
    }
}
