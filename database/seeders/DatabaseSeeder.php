<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Insert roles into the roles table
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Intern'],
            ['name' => 'Customer'],
            ['name' => 'Customer Admin'],
            ['name' => 'Extern'],
            ['name' => 'Sales'],
            ['name' => 'Developer'],
            ['name' => 'Writer'],
            ['name' => 'Content Manager'],
            ['name' => 'Supplier'],
        ];
        DB::table('roles')->insert($roles);

        DB::table('companies')->insert([
            'id' => 1,
            'name' => 'Digital Newsgroup',
            'created_at' => now(),
        ]);

        DB::table('projects')->insert([
            'id' => 1,
            'name' => 'DNG',
            'company_id' => 1,
            'created_at' => now(),
        ]);

        DB::table('project_domains')->insert([
            'id' => 1,
            'domain_name' => 'dng.nl',
            'company_id' => 1,
            'project_id' => 1,
            'created_at' => now(),
        ]);

        $this->call([
            WebsiteZoneSeeder::class,
            CategoriesTableSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Jelle Visser',
            'role_id' => 7,
            'company_id' => 1,
            'email' => 'jellev98@outlook.com',
            'password' => bcrypt('password'),
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
