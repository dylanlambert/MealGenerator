<?php

declare(strict_types=1);

namespace App\Application\Recipe\Dto;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="RecipeDto"),
 * @OA\Property(property="id", type="string", format="uuid"),
 * @OA\Property(property="name", type="string", example="Boeuf Bourgignon"),
 * @OA\Property(property="preparationTime", type="string", example="16m"),
 * @OA\Property(
 *      property="ingredients",
 *     type="array",
 *     @OA\Items(
 *          @OA\Property(property="ingredientName", type="string", example="6 Carrotes"),
 *      )
 * ),
 * @OA\Property(property="recipe", type="string"),
 * )
 *
 * Class RecipeDto
 *
 */
final class RecipeDto
{
    public string $id;
    public string $name;
    public string $preparationTime;
    public array $ingredients;
    public string $recipe;

    public function __construct(string $id, string $name, string $preparationTime, array $ingredients, string $recipe)
    {
        $this->id = $id;
        $this->name = $name;
        $this->preparationTime = $preparationTime;
        $this->ingredients = $ingredients;
        $this->recipe = $recipe;
    }
}
