<?php

namespace spec\App\Domain\Entities;

use App\Domain\Entities\Ingredient;
use App\Domain\Entities\MeasuredIngredient;
use App\Domain\Entities\MeasuredIngredientList;
use App\Domain\Entities\Recipe;
use App\Domain\Entities\RecipeList;
use App\Domain\Utils\Id\StringId;
use App\Domain\Utils\Measurement\Gramme;
use App\Domain\Utils\PreparationTime\PreparationTime;
use PhpSpec\ObjectBehavior;

class RecipeListSpec extends ObjectBehavior
{
    function it_filters_under_preaparation_time_givent()
    {
        $this->beConstructedWith(
            new Recipe(
                new StringId('recipe-id-1'),
                'Recipe 1',
                new PreparationTime(600),
                new MeasuredIngredientList(
                ...[
                    new MeasuredIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                    new MeasuredIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                ]
            )
            ),
            new Recipe(
                new StringId('recipe-id-2'),
                'Recipe 2',
                new PreparationTime(3600),
                new MeasuredIngredientList(
                ...[
                    new MeasuredIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                    new MeasuredIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                ]
            )
            ),
        );

        $resultList = new RecipeList(
            new Recipe(
                new StringId('recipe-id-1'),
                'Recipe 1',
                new PreparationTime(600),
                new MeasuredIngredientList(
                ...[
                    new MeasuredIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                    new MeasuredIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                ]
            )
            ),
        );

        $this->getUnderPreparationTime(new PreparationTime(1800))->shouldBeLike($resultList);
    }

    function it_checks_if_not_empty()
    {
        $this->beConstructedWith(
            new Recipe(
                new StringId('recipe-id-1'),
                'Recipe 1',
                new PreparationTime(600),
                new MeasuredIngredientList(
                ...[
                    new MeasuredIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                    new MeasuredIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                ]
            )
            ),
            new Recipe(
                new StringId('recipe-id-2'),
                'Recipe 2',
                new PreparationTime(3600),
                new MeasuredIngredientList(
                ...[
                    new MeasuredIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                    new MeasuredIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                ]
            )
            ),
        );

        $this->isEmpty()->shouldBe(false);
    }

    function it_checks_if_empty()
    {
        $this->beConstructedWith();
        $this->isEmpty()->shouldBe(true);
    }
}
