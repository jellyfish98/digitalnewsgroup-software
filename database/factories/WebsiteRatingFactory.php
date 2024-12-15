<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Website;
use App\Models\WebsiteRating;

class WebsiteRatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WebsiteRating::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ahrefs_updated' => $this->faker->dateTime(),
            'ahrefs_domain_rating' => $this->faker->numberBetween(-10000, 10000),
            'ahrefs_referring_domains' => $this->faker->numberBetween(-10000, 10000),
            'ahrefs_url_rating' => $this->faker->numberBetween(-10000, 10000),
            'ahrefs_linked_domains' => $this->faker->numberBetween(-10000, 10000),
            'majestic_citation_flow' => $this->faker->numberBetween(-10000, 10000),
            'majestic_trust_flow' => $this->faker->numberBetween(-10000, 10000),
            'moz_domain_authority' => $this->faker->numberBetween(-10000, 10000),
            'moz_spam_score' => $this->faker->numberBetween(-10000, 10000),
            'website_id' => Website::factory(),
        ];
    }
}
