<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\game;

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
public function store(PostRequest $request, Post $post)
{
    $input = $request['post'];
    $input += ['user_id' => $request->user()->id];    //この行を追加
    $post->fill($input)->save();
     // データを保存
   
    return redirect('/posts/' . $post->id);
    $game = new Game();
    $game->title = $request->input('title');
    $game->genre = $request->input('genre');
    $game->platforms = $request->input('platforms');
    $game->mode = $request->input('mode');
    $game->playstyle = $request->input('playstyle');
    $game->rank = $request->input('rank');
    $game->image_url = $request->input('image_url');
    $game->body = $request->input('body');
    $game->voice_chat = $request->has('voice_chat');
    $game->save();

}
public function edit(Post $post)
{
    return view('posts.edit')->with(['post' => $post]);
}

public function update(PostRequest $request, Post $post)
{
    $input_post = $request['post'];
    $input_post += ['user_id' => $request->user()->id];   //この行を追加
    $post->fill($input_post)->save();
    return redirect('/posts/' . $post->id);
}

public function delete(Post $post)
{
    $post->delete();
    return redirect('/');
}
public function create(Category $category)
{
    return view('posts.create')->with(['categories' => $category->get()]);
}

}
?>