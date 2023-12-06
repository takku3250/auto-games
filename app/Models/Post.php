<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// Userクラスのuse宣言
use App\Models\User;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function getPaginateByLimit(int $limit_count =5)
{
    return $this::with("user","category")->orderBy("updated_at","DESC")->paginate($limit_count);
    // updated_atで降順に並べたあと、limitで件数制限をかける
}
protected $fillable = [
    'title',
    'body',
    "category_id",
    "user_id",
    'game_title',
    'game_genre',
    'game_platforms',
    'game_mode',
    'game_playstyle',
    'game_rank',
    'game_voice_chat',
];
public function category()
{
    return $this->belongsTo(Category::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}

}
