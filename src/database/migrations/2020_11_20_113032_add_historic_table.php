<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHistoricTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historics', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->uuid('recipe_id');
            $table
                ->foreign('recipe_id')
                ->references('id')
                ->on('recipes')
            ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('historics');
    }
}
