<?php

namespace Database\Seeders;

use App\Models\WebsiteZone;
use Illuminate\Database\Seeder;

class WebsiteZoneSeeder extends Seeder
{
    public function run(): void
    {
        $zones = [
            1 => [
                'name' => 'Aanbod Regulier',
                'description' => 'Betaalde plaatsingen',
            ],
            2 => [
                'name' => 'Aanbod Budget',
                'description' => "Blogruil, linkruil, Startpagina's",
            ],
            3 => [
                'name' => 'Blacklist',
                'description' => 'Websites waar we geen zaken meer mee doen.',
            ],
            4 => [
                'name' => 'New Items',
                'description' => 'New Items (Waiting for metrics) Hier moeten de waardes ingeladen worden.',
            ],
            5 => [
                'name' => 'On Hold',
                'description' => 'Alles met de supplier PROJECT BENADEREN komt hier in te staan Websites die we moeten benaderen.',
            ],
            6 => [
                'name' => 'Supplier Imported',
                'description' => 'Domeinen die geïmporteerd zijn door suppliers.',
            ],
            7 => [
                'name' => 'Declined',
                'description' => 'Domeinen die geïmporteerd zijn door suppliers. Deze zijn afgewezen.',
            ],
        ];

        foreach ($zones as $zone) {
            WebsiteZone::create([
                'name' => $zone['name'],
                'description' => $zone['description'],
            ]);
        }
    }
}
