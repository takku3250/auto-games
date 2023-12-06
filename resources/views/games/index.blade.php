<!DOCTYPE html>
<html>
    <head>
        <title>ゲーム一覧</title>
    </head>
    <body>
        <h1>ゲーム一覧</h1>
        
        <ul>
            @foreach($games as $game)
            <li>{{ $game ->title}}</li>
            @endforeach
        </ul>
    </body>
</html>
