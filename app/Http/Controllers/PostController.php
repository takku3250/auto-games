<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Requests\PostRequest;

class PostController extends Controller
{
public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
{
   return view('posts.index')->with(['posts' => $post->getPaginateByLimit(1)]);
       //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
    
}
public function show(Post $post)
  {
    return view('posts.show')->with(['post' => $post]);
 //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
  }
  public function create()
{
    return view('posts.create');
}
public function store(Request $request, Post $post)
{
    $input = $request['post'];
    $post->fill($input)->save(); 
    return redirect('/posts/' . $post->id);
}
}
?>