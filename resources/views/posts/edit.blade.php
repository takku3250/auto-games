<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>ゲームマッチングアプリ</title>
         </head>
    <body>
        <h1 class="title">募集投稿 編集画面</h1>
        <form action="/posts/{{ $post->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="content_title">
                <h2>募集作成</h2>
                <input type="text" name="post[title]" value="{{ $post->title }}">
                <p  class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
                
            <div class="content_body">
                <h2>ひとこと</h2>
                <input type='text' name='post[body]' value="{{ $post->body}}">
            </div>
                <input type="submit" value="募集を投稿する"/>
        </form>
                
                <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>