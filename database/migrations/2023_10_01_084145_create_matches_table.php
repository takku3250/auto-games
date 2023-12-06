<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable  extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            //外部キー
           $table->foreignId("post_id")->references("id")->on("posts");
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
        Schema::dropIfExists('matches');
    }
};
