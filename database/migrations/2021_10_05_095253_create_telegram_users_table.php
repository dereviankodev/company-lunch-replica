<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramUsersTable extends Migration
{
    public function up()
    {
        Schema::create('telegram_users', function (Blueprint $table) {
            $table->string('id')->primary()->unique();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('photo_url');
            $table->timestamp('auth_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('telegram_users');
    }
}
