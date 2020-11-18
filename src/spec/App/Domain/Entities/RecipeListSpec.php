<?php

namespace spec\App\Domain\Entities;

use App\Domain\Entities\Ingredient;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Entities\QuantifiedIngredientList;
use App\Domain\Entities\Recipe;
use App\Domain\Entities\RecipeList;
use App\Domain\Utils\Id\StringId;
use App\Domain\Utils\Measurement\Gramme;
use App\Domain\Utils\Measurement\Milliliter;
use App\Domain\Utils\Measurement\Unit;
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
                new QuantifiedIngredientList(
                ...[
                    new QuantifiedIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                    new QuantifiedIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                ]
            ),
                'process',
            ),
            new Recipe(
                new StringId('recipe-id-2'),
                'Recipe 2',
                new PreparationTime(3600),
                new QuantifiedIngredientList(
                ...[
                    new QuantifiedIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                    new QuantifiedIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                ]
            ),
                'process',
            ),
        );

        $resultList = new RecipeList(
            new Recipe(
                new StringId('recipe-id-1'),
                'Recipe 1',
                new PreparationTime(600),
                new QuantifiedIngredientList(
                ...[
                    new QuantifiedIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                    new QuantifiedIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                ]
            ),
                'process',
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
                new QuantifiedIngredientList(
                ...[
                    new QuantifiedIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                    new QuantifiedIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                ]
            ),
                'process',
            ),
            new Recipe(
                new StringId('recipe-id-2'),
                'Recipe 2',
                new PreparationTime(3600),
                new QuantifiedIngredientList(
                ...[
                    new QuantifiedIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                    new QuantifiedIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                ]
            ),
                'process',
            ),
        );

        $this->isEmpty()->shouldBe(false);
    }

    function it_checks_if_empty()
    {
        $this->beConstructedWith();
        $this->isEmpty()->shouldBe(true);
    }

    function it_return_calculated_measured_ingredient_list()
    {
        $this->beConstructedWith(
            new Recipe(
                new StringId('pate-carbonara-id'),
                'Pâte carbonara',
                new PreparationTime(600),
                new QuantifiedIngredientList(
                    ...[
                           new QuantifiedIngredient(
                               new Milliliter(200),
                               new Ingredient(new StringId('creme-liquide-id'), 'Crème liquide')
                           ),
                           new QuantifiedIngredient(
                               new Gramme(100),
                               new Ingredient(new StringId('frommage-rappé-id'), 'Fromage Rappé')
                           ),
                           new QuantifiedIngredient(
                               new Unit(1),
                               new Ingredient(new StringId('oeuf-id'), 'Oeuf')
                           ),
                       ]
                ),
                'recette des pâtes carbonara',
            ),
            new Recipe(
                new StringId('Tartiflette-id'),
                'Tartiflette',
                new PreparationTime(3600),
                new QuantifiedIngredientList(
                    ...[
                           new QuantifiedIngredient(
                               new Milliliter(100),
                               new Ingredient(new StringId('creme-liquide-id'), 'Crème liquide')
                           ),
                           new QuantifiedIngredient(
                               new Gramme(500),
                               new Ingredient(new StringId('pomme-de-terre-id'), 'Pomme de terre')
                           ),
                           new QuantifiedIngredient(
                               new unit(1),
                               new Ingredient(new StringId('roblochon-id'), 'Roblochon')
                           ),
                           new QuantifiedIngredient(
                               new unit(1),
                               new Ingredient(new StringId('oeuf-id'), 'Oeuf')
                           ),
                       ]
                ),
                'Recette de la tartiflette',
            ),
            new Recipe(
                new StringId('Croziflette-id'),
                'Croziflette',
                new PreparationTime(3600),
                new QuantifiedIngredientList(
                    ...[
                           new QuantifiedIngredient(
                               new Milliliter(100),
                               new Ingredient(new StringId('creme-liquide-id'), 'Crème liquide')
                           ),
                           new QuantifiedIngredient(
                               new Gramme(500),
                               new Ingredient(new StringId('crozet-id'), 'crozet')
                           ),
                           new QuantifiedIngredient(
                               new unit(1),
                               new Ingredient(new StringId('roblochon-id'), 'Roblochon')
                           ),
                           new QuantifiedIngredient(
                               new unit(1),
                               new Ingredient(new StringId('oeuf-id'), 'Oeuf')
                           ),
                       ]
                ),
                'Recette de la croziflette',
            ),
        );

        $quantifiedIngredientList = new QuantifiedIngredientList(
            new QuantifiedIngredient(
                new Milliliter(400),
                new Ingredient(new StringId('creme-liquide-id'), 'Crème liquide')
            ),
            new QuantifiedIngredient(
                new Gramme(100),
                new Ingredient(new StringId('frommage-rappé-id'), 'Fromage Rappé')
            ),
            new QuantifiedIngredient(
                new unit(3),
                new Ingredient(new StringId('oeuf-id'), 'Oeuf')
            ),
            new QuantifiedIngredient(
                new Gramme(500),
                new Ingredient(new StringId('pomme-de-terre-id'), 'Pomme de terre')
            ),
            new QuantifiedIngredient(
                new unit(2),
                new Ingredient(new StringId('roblochon-id'), 'Roblochon')
            ),
            new QuantifiedIngredient(
                new Gramme(500),
                new Ingredient(new StringId('crozet-id'), 'crozet')
            ),
        );

        $this->getIngredientsCombined()->shouldBeLike($quantifiedIngredientList);
    }
}
