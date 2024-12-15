<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'briefing' => $this->faker->text(),
            'payment_status' => $this->faker->word(),
            'payment_method' => $this->faker->word(),
            'user_id' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
