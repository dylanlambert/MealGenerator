<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use function array_reduce;
use function array_map;
use function array_walk;

final class QuantifiedIngredientList
{
    /** @var QuantifiedIngredient[] */
    private array $measuredIngredients;

    public function __construct(QuantifiedIngredient ...$ingredients)
    {
        /** @var QuantifiedIngredient[] $result */
        $result = array_reduce(
            $ingredients,
            function (array $array, QuantifiedIngredient $ingredient) {
                $key = self::arrayFind(
                    $array,
                    function (QuantifiedIngredient $ingredientToCompare) use ($ingredient) {
                        $measurementToCompare = $ingredientToCompare->getQuantity();
                        return $ingredient->getIngredient()->getId()->sameAs(
                            $ingredientToCompare->getIngredient()->getId()
                        ) && $ingredient->getQuantity() instanceof $measurementToCompare;
                    }
                );

                if ($key !== null) {
                    $array[$key] = $array[$key]->addQuantity($ingredient->getQuantity());
                    return $array;
                }
                return [...$array, $ingredient];
            },
            []
        );

        $this->measuredIngredients = $result;
    }

    /**
     * @template T
     * @param callable(QuantifiedIngredient):T $callable
     * @return mixed[]
     * @phpstan-return T[]
     */
    public function map(callable $callable): array
    {
        return array_map($callable, $this->measuredIngredients);
    }

    public function walk(callable $callable): void
    {
        array_walk($this->measuredIngredients, $callable);
    }

    /**
     * @template Item
     * @phpstan-param array<mixed, Item> $array
     * @phpstan-param callable(Item): bool $finder
     * @phpstan-return int|string|null
     * @param array $array
     * @return mixed
     */
    private static function arrayFind(array $array, callable $finder)
    {
        foreach ($array as $key => $item) {
            if ($finder($item)) {
                return $key;
            }
        }

        return null;
    }
}
