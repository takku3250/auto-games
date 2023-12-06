<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = "messages";
     protected $fillable = [
        'message',
        'owner_id',
        'guest_id',
        'room_id',
    ];
    public function chats()
    {
        return $this->hasMany(Chat::class, 'guest_id', 'id');
    }
     public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function guest()
    {
        return $this->belongsTo(User::class, 'guest_id');
    }

}