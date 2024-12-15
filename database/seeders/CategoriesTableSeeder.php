<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $categoriesData = [
            (object)[
                'name' => 'News',
                'translation_key' => 'news',
            ],
            (object)[
                'name' => 'Hobbies & Leisure',
                'translation_key' => 'hobbies_leisure',
            ],
            (object)[
                'name' => 'Gadgets & Hardware',
                'translation_key' => 'gadgets_hardware',
            ],
            (object)[
                'name' => 'Women\'s Lifestyle',
                'translation_key' => 'womens_lifestyle',
            ],
            (object)[
                'name' => 'Media & Books',
                'translation_key' => 'media_books',
            ],
            (object)[
                'name' => 'Finance & Insurance',
                'translation_key' => 'finance_insurance',
            ],
            (object)[
                'name' => 'Travel',
                'translation_key' => 'travel',
            ],
            (object)[
                'name' => 'Automotive (Vehicles)',
                'translation_key' => 'automotive_vehicles',
            ],
            (object)[
                'name' => 'Sports & Exercise',
                'translation_key' => 'sports_exercise',
            ],
            (object)[
                'name' => 'Home & Garden',
                'translation_key' => 'home_garden',
            ],
            (object)[
                'name' => 'Health & Personal Care',
                'translation_key' => 'health_personal_care',
            ],
            (object)[
                'name' => 'Food & Drink',
                'translation_key' => 'food_drink',
            ],
            (object)[
                'name' => 'Technology & Software',
                'translation_key' => 'technology_software',
            ],
            (object)[
                'name' => 'Clothing & Fashion',
                'translation_key' => 'clothing_fashion',
            ],
            (object)[
                'name' => 'Music & Film',
                'translation_key' => 'music_film',
            ],
            (object)[
                'name' => 'Marketing & Communication',
                'translation_key' => 'marketing_communication',
            ],
            (object)[
                'name' => 'Promotional Gifts',
                'translation_key' => 'promotional_gifts',
            ],
            (object)[
                'name' => 'Beauty',
                'translation_key' => 'beauty',
            ],
            (object)[
                'name' => 'Business',
                'translation_key' => 'business',
            ],
            (object)[
                'name' => 'Parent & Child',
                'translation_key' => 'parent_child',
            ],
            (object)[
                'name' => '18+',
                'translation_key' => '18+',
            ],
            (object)[
                'name' => 'Legal',
                'translation_key' => 'legal',
            ],
            (object)[
                'name' => 'Catering & Hospitality',
                'translation_key' => 'catering_hospitality',
            ],
            (object)[
                'name' => 'Animals',
                'translation_key' => 'animals',
            ],
            (object)[
                'name' => 'Construction',
                'translation_key' => 'construction',
            ],
            (object)[
                'name' => 'Sustainability',
                'translation_key' => 'sustainability',
            ],
            (object)[
                'name' => 'Games & Toys',
                'translation_key' => 'games_toys',
            ],
            (object)[
                'name' => 'Men\'s Lifestyle',
                'translation_key' => 'mens_lifestyle',
            ],
            (object)[
                'name' => 'General Lifestyle',
                'translation_key' => 'general_lifestyle',
            ],
        ];

        foreach ($categoriesData as $cData) {
            Category::create([
                'name' => $cData->name,
                'translation_key' => $cData->translation_key,
            ]);
        }
    }

}
