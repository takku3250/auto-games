<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('message'); // メッセージテキスト
            //$table->bigInteger('send')->comment('送信者');
            //$table->bigInteger('recieve')->comment('受信者');
            $table->bigInteger("room_id");
            $table->timestamps();
            //外部キー
           $table->foreignId('owner_id')->references('id')->on('users'); //募集した人
           $table->foreignId('guest_id')->references('id')->on('users'); //マッチングを送った人
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
