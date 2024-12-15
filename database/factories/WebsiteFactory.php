<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Website;
use App\Models\WebsiteZone;

class WebsiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Website::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'domain_name' => $this->faker->companySuffix . '-' . $this->faker->unique()->domainName,
            'cost_price' => $costPrice = $this->faker->randomFloat(2, 1, 10000), // Ensure cost_price is between 1 and 10,000
            'retail_price' => $retailPrice = $this->faker->randomFloat(2, $costPrice * 1.2, min($costPrice * 1.9, 10000)), // Ensure retail_price stays reasonable
            'margin' => round(($retailPrice - $costPrice) / $costPrice * 100, 2), // Calculate margin percentage
            'supplier_email' => $this->faker->email(),
            'pictures' => null,
            'ip_address' => $this->faker->ipv4(),
            'follow' => $this->faker->boolean(),
            'sponsored_tag' => $this->faker->boolean(),
            'backlinks' => $this->faker->numberBetween(1, 4),
            'main_country' => $this->faker->countryCode(),
            'delete_reason' => null,
            'blog_duration' => $this->faker->randomElement(['1 year', '2 year', 'permanent']),
            'write_content' => $this->faker->randomElement(['dng', 'supplier']),
            'minimal_words' => $this->faker->numberBetween(500, 10000),
            'website_type' => $this->faker->randomElement(['blog', 'backlink', 'blog & backlink']),
            'dng_requirements' => $this->faker->sentence(),
            'content_requirements' => $this->faker->sentence(),
            'supplier_requirements' => $this->faker->sentence(),
            'website_zone_id' => $this->faker->randomElement(WebsiteZone::pluck('id')->toArray()),
        ];

    }
}
