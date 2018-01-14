<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('Имя пользователя, тоже уникальное');
            $table->string('email')->unique()->comment('Email');
            $table->string('password')->comment('Пароль');
            $table->string('firstname')->index()->comment('Имя пользотеля, именно как зовут');
            $table->string('lastname')->index()->comment('Фамилия пользователя');
            $table->decimal('balance', 10, 2)->comment('Храним тут баланс, хотя конечно это и неправильно');
            $table->string('role')->index()->comment('Роль пользователя, тоже неправильно хранить в одной таблице, но раз уж начали...');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
