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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // ゲーム名
            $table->string('genre'); // ジャンル
            $table->string('platforms'); // プラットフォーム
            $table->string('mode')->nullable(); 
            $table->string('playstyle')->nullable();
            $table->integer('rank')->nullable();
             $table->string('image_url')->nullable(); // ゲーム画像のURL
             $table->text("body");
            $table->boolean("voice_chat")->default(false);//ボイスチャット可否
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
        Schema::dropIfExists('games');
    }
};
