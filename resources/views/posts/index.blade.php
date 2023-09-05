<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Game mathing</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body class="antialiased">
        <h1>Game mathing</h1>
        <h1>募集投稿</h1>
        <div class='posts'>
             @foreach ($posts as $post)
            <div class='post'>
                <h2 class='title'>
            <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
                <p class='body'>{{ $post->body }}</p>
            </div>
             @endforeach
        </div>
        <div class='Paginate'>{{ $posts->links() }}
        </div>
    </body>
</html>