<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Game mathing</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
 <x-app-layout>
    <x-slot name="header">
        index
    </x-slot>
    <body class="antialiased">
        <h1>Game mathing</h1>
        <a href="/posts/create">ゲーム募集を作る</a>
        <div class='posts'>
             @foreach ($posts as $post)
            <div class='post'>
                <h2 class='title'>  
                <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
                <p class='body'>{{  $post->body  }}</p>
                <small>{{ $post->user->name }}</small>
             <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
              @csrf
              @method('DELETE')
              <button type="button" onclick="deletePost({{ $post->id }})"></button> 
　　　　　　　</form>
            </div>
            <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
        </div>
        @if($post->user->id == Auth::id())
        <a href = "/matching/list">自分の募集です。（募集一覧へ）</a>
        @else
        <form action ="{{route('matches.store')}}" method = "post">
            @csrf
            <input type="hidden" name = "owner_id" value = "{{$post ->user->id}}">
            <input type="hidden" name = "post_id" value = "{{$post->id}}">
            
            <input type="submit" value="募集に参加する">
            </form>
        @endif
     @endforeach
      <div class='paginate'>
            {{ $posts->links() }}
        </div>
    　　<script>
    　　function deletePost(id) {
        　　'use strict'

        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
        　　　}
   　　 }
　　　　</script>
　　　</body>
  </x-app-layout>
</html>