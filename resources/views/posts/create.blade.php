<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>ゲームマッチングアプリ</title>
         </head>
         <x-app-layout>
    <x-slot name="header">
        create
    </x-slot>
    <body>
        <h1>募集投稿</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="title">
                <h2>募集作成</h2>
                <input type="text" name="post[title]" placeholder="(例)⚪︎⚪︎のゲームがしたいです！" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
                
            <div class="body">
                <h2>ひとこと</h2>
                <textarea name="post[body]" placeholder="楽しくやれる人募集中です！。">{{old("post.body")}}</textarea>
            
                <p class="body_error" style="color:red">{{$errors->first("post.body")}}</p>
            </div>
                 <div class="category">
                  <h2>Category</h2>
                   <select name="post[category_id]">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                   @endforeach
                    </select>
            </div>
            <input type="submit" value="募集を投稿する"/>
        
        </form>
                
    <div class="footer">
      <a href="/">戻る</a>
    </div>
  
    </body>
  </x-app-layout>
</html>