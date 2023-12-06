<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Post;
use App\Notifications\ResetPasswordNotification;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function sendPasswordResetNotification($token)
    {
        $url = url("reset-password/${token}");
        $this->notify(new ResetPasswordNotification($url));
    }
   public function matchesAsOwner()
    {
        return $this->belongsToMany(User::class, 'matches','guest_id', 'owner_id');
    }
 public function test()
    {
        return $this->belongsToMany(User::class, 'messages','guest_id', 'owner_id');
    }
    //public function matchesAsGuest()
   // {
       // return $this->hasMany(Matches::class, 'post_id');
    //}
    public function posts()   
{
    return $this->hasMany(Post::class);  
}
   public function get_room_messages()
    {
//userがauthにauthがuserに送ったメッセージを取得する必要がある。
        return  $this->test()->where('owner_id', Auth::id())->orWhere(function ($q) {
            $q->where("guest_id", Auth::id())->where('owner_id', $this->id);
        });
    }
    public function owner()
    {
        return $this->belongsToMany(User::class,'matches', 'owner_id','guest_id');
    }

    public function guest()
    {
        return $this->belongsToMany(User::class, 'matches','guest_id','owner_id');
    }
}
