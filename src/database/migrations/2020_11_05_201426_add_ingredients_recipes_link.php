<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIngredientsRecipesLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_ingredients', function (Blueprint $table){
            $table->uuid('recipe_id');
            $table->uuid('ingredient_id');
            $table
                ->foreign('recipe_id')
                ->references('id')
                ->on('recipes')
            ;

            $table
                ->foreign('ingredient_id')
                ->references('id')
                ->on('ingredients')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recipe_ingredients');
    }
}
