<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id_sender')->index()->nullable(false)->comment('Ссылка на пользователя отправителя');
            $table->integer('user_id_recipient')->index()->nullable(false)->comment('Ссылка на пользователя получателя');
            $table->decimal('amount', 10, 2)->nullable(false)->comment('Сумма транзакции');
            $table->text('description')->comment('Описание транзакции');
            $table->string('type')->nullable(false)->index()->comment('Тип транзакции web или console');
            $table->integer('user_id')->index()->nullable('false')->comment('Ссылка на пользователя создателя транзакции');
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
        Schema::dropIfExists('transactions');
    }
}
