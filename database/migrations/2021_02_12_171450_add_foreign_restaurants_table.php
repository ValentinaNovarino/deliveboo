<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('dish_id')->nullable()->after('user_id');
            $table->foreign('dish_id')->references('id')->on('dishes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropForeign('restaurants_dish_id_foreign');
            $table->dropColumn('dish_id');
            $table->dropForeign('restaurants_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
