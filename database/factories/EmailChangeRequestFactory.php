<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\EmailChangeRequest;

class EmailChangeRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmailChangeRequest::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'new_email' => $this->faker->word(),
            'user_id' => $this->faker->numberBetween(-10000, 10000),
            'hash' => $this->faker->word(),
            'expires_at' => $this->faker->dateTime(),
        ];
    }
}
