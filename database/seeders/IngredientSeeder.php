<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    public function run()
    {
        $ingredients = [
            [
                'name' => 'Hyaluronic Acid',
                'suitable_for' => ['OSNT', 'OSNW', 'OSPT', 'OSPW', 'DSNT', 'DSNW', 'DSPT', 'DSPW']
            ],
            [
                'name' => 'Niacinamide',
                'suitable_for' => ['OSNT', 'OSNW', 'OSPT', 'OSPW']
            ],
            [
                'name' => 'Vitamin C',
                'suitable_for' => ['OSNT', 'OSNW', 'OSPT', 'OSPW']
            ],
            [
                'name' => 'Salicylic Acid',
                'suitable_for' => ['OSNT', 'OSPT']
            ],
            [
                'name' => 'Ceramide',
                'suitable_for' => ['DSNT', 'DSNW', 'DSPT', 'DSPW']
            ],
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::updateOrCreate(
                ['name' => $ingredient['name']],
                ['suitable_for' => $ingredient['suitable_for']]
            );
        }
    }
}
