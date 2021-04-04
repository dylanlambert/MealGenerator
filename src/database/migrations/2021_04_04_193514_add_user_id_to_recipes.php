<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $uuid = DB::query()->from('users')->select('id')->where('adresse_email', 'dy.lambert@gmail.com')->first()->id;

        Schema::table('recipes', function (Blueprint $table) {
            $table->uuid('user_id')->nullable(true);
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE')
            ;
        });

        DB::statement(sprintf("UPDATE recipes SET user_id = '%s'", $uuid));

        Schema::table('recipes', function(Blueprint $table) {
            $table->uuid('user_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropForeign('recipes_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
