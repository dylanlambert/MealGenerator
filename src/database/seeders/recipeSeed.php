<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class recipeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipes')->insert([
            'id' => '272d25b3-3f53-4a89-a6e4-e69f1084dbfa',
            'name' => 'Pâte carbonara',
            'preparation_time' => 900,
        ]);


        DB::table('ingredients')->insert(
            [
                [
                    'id' => '9490d91c-a267-46b2-87bf-63d37c15011b',
                    'name' => 'Pâte fraiche',
                ],
                [
                    'id' => 'd4986bdb-5461-491b-a8e9-fb03d84cbcb4',
                    'name' => 'Lardon',
                ],
                [
                    'id' => '53f6cde3-e172-4359-bbac-4968f7f12e17',
                    'name' => 'Crème',
                ],
                [
                    'id' => '080565c8-03e9-496b-8f52-aa2f63e0f89c',
                    'name' => 'Fromage rappé',
                ]
            ]
        );

        DB::table('recipe_ingredients')->insert(
            [
                [
                    'recipe_id' => '272d25b3-3f53-4a89-a6e4-e69f1084dbfa',
                    'ingredient_id' => '9490d91c-a267-46b2-87bf-63d37c15011b',
                    'measurement' => 'gramme',
                    'quantity' => 200,
                ],
                [
                    'recipe_id' => '272d25b3-3f53-4a89-a6e4-e69f1084dbfa',
                    'ingredient_id' => 'd4986bdb-5461-491b-a8e9-fb03d84cbcb4',
                    'measurement' => 'gramme',
                    'quantity' => 150,
                ],
                [
                    'recipe_id' => '272d25b3-3f53-4a89-a6e4-e69f1084dbfa',
                    'ingredient_id' => '53f6cde3-e172-4359-bbac-4968f7f12e17',
                    'measurement' => 'liter',
                    'quantity' => 20,
                ],
                [
                    'recipe_id' => '272d25b3-3f53-4a89-a6e4-e69f1084dbfa',
                    'ingredient_id' => '080565c8-03e9-496b-8f52-aa2f63e0f89c',
                    'measurement' => 'gramme',
                    'quantity' => 100,
                ],
            ],
        );
    }
}
