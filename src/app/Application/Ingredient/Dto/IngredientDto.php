<?php

declare(strict_types=1);

namespace App\Application\Ingredient\Dto;

use JsonSerializable;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="RecipeDto"),
 * @OA\Property(property="id", type="string", format="uuid"),
 * @OA\Property(property="name", type="string", example="Boeuf Bourgignon")
 * )
 *
 * Class IngredientDto
 *
 */
final class IngredientDto implements JsonSerializable
{
    private string $id;
    private string $name;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array<string,mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
