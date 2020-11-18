<?php

declare(strict_types=1);

namespace App\Domain\Entities;

final class QuantifiedIngredientList
{
    /** @var QuantifiedIngredient[] */
    private array $measuredIngredients;

    public function __construct(QuantifiedIngredient ...$ingredients)
    {
        /** @var array $result */
        $result = array_reduce(
            $ingredients,
            function (array $array, QuantifiedIngredient $ingredient) {
                $key = self::array_find(
                    $array,
                    function (QuantifiedIngredient $ingredientToCompare) use ($ingredient) {
                        $measurementToCompare = $ingredientToCompare->getQuantity();
                        return $ingredient->getIngredient()->getId()->sameAs($ingredientToCompare->getIngredient()->getId()) && $ingredient->getQuantity() instanceof $measurementToCompare;
                    }
                );

                if($key !== null) {
                    $array[$key] = $array[$key]->addQuantity($ingredient->getQuantity());
                    return $array;
                }
                return [...$array, $ingredient];
            },
            []
        );

        $this->measuredIngredients = $result;
    }

    public function map(callable $callable)
    {
        return array_map($callable, $this->measuredIngredients);
    }

    public function walk(callable $callable)
    {
        array_walk($this->measuredIngredients, $callable);
    }

    private static function array_find(array $array, callable $finder)
    {
        foreach ($array as $key => $item) {
            if ($finder($item)) {
                return $key;
            }
        }

        return null;
    }
}
