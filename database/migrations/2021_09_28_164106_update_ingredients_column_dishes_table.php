<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIngredientsColumnDishesTable extends Migration
{
    public function up()
    {
        Schema::table('dishes', function (Blueprint $table) {
            $table->string('ingredients')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('dishes', function (Blueprint $table) {
            $table->string('ingredients')->nullable(false)->change();
        });
    }
}
