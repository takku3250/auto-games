<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable=[
        "title",
        "genre",
        "gamemode",
        "rank",
        "playstyle",
        "platforms",
        "image_url",
        "voice_chat",
        "body",
];

}

