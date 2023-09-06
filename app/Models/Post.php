<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function getPaginateByLimit(int $limit_count =10)
{
    return $this-> orderBy("updated_at","DESC")->paginate($limit_count);
    // updated_atで降順に並べたあと、limitで件数制限をかける
}
protected $fillable = [
    'title',
    'body',
];
}
