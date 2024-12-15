<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Company;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'backlinks_retrieved' => $this->faker->numberBetween(-10000, 10000),
            'backlink_retrieval_limit' => $this->faker->numberBetween(-10000, 10000),
            'address' => $this->faker->word(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'postal_code' => $this->faker->postcode(),
            'exclude_stripe_wallet' => $this->faker->boolean(),
        ];
    }
}
