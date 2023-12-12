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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('body', 200);
            $table->boolean('is_matching')->default(0);
            $table->string('game_title')->nullable();
            $table->string('game_genre')->nullable();
            $table->string('game_platforms')->nullable();
            $table->string('game_mode')->nullable();
            $table->string('game_playstyle')->nullable();
            $table->string('game_rank')->nullable();
            $table->boolean('game_voice_chat')->nullable();
            $table->foreignId("user_id")->default(1);
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
        Schema::dropIfExists('posts');
    }
};
