<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>ゲームマッチングアプリ</title>
         </head>
    <body>
        <h1>募集投稿</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="title">
                <h2>募集作成</h2>
                <input type="text" name="post[title]" placeholder="(例)⚪︎⚪︎のゲームがしたいです！"/>
                </div>
            <div class="body">
                <h2>ひとこと</h2>
                <textarea name="post[body]" placeholder="楽しくやれる人募集中です！。"></textarea>
                </div>
                <input type="submit" value="募集を投稿する"/>
                </form>
                <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>