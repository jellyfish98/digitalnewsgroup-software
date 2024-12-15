<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\;
use App\Models\Project;
use App\Models\ProjectDomain;

class ProjectDomainFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectDomain::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'domain_name' => $this->faker->word(),
            'domain_alias' => $this->faker->word(),
            'company_id' => ::factory(),
            'project_id' => Project::factory(),
        ];
    }
}
