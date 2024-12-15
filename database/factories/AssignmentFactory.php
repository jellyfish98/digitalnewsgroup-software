<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\;
use App\Models\Assignment;
use App\Models\Company;

class AssignmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Assignment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'project_id' => ::factory(),
            'website_id' => ::factory(),
            'project_domain_id' => ::factory(),
            'order_id' => ::factory(),
        ];
    }
}
