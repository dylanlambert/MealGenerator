<?php

declare(strict_types=1);

namespace App\Application\Recipe;

use App\Domain\Utils\Id\Id;

final class RecipeRetrieverRequest
{
    private Id $id;

    public function __construct(Id $id)
    {
        $this->id = $id;
    }

    public function getId(): Id
    {
        return $this->id;
    }
}
