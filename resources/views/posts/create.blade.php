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
             <div class="games">
        <h2>ゲーム情報</h2>
        <input type="text" name="post[game_title]" placeholder="ゲーム名" value="{{ old('post.game_title') }}"/>
        <br>
        <br>
        <input type="text" name="post[game_genre]" placeholder="ジャンル" value="{{ old('post.game_genre') }}"/>
        <br>
        <br>
        <input type="text" name="post[game_platforms]" placeholder="プラットフォーム" value="{{ old('post.game_platforms') }}"/>
        <br>
        <br>
        <input type="text" name="post[game_mode]" placeholder="モード" value="{{ old('post.game_mode') }}"/>
        <br>
        <br>
        <input type="text" name="post[game_playstyle]" placeholder="プレイスタイル" value="{{ old('post.game_playstyle') }}"/>
        <br>
       <div class="rank">
           <h2>ランク</h2>
           <select name="post[game_rank]">
        <option value="ブロンズ" {{ old('post.game_rank') == 'ブロンズ' ? 'selected' : '' }}>ブロンズ</option>
        <option value="シルバー" {{ old('post.game_rank') == 'シルバー' ? 'selected' : '' }}>シルバー</option>
        <option value="ゴールド" {{ old('post.game_rank') == 'ゴールド' ? 'selected' : '' }}>ゴールド</option>
        <option value="プラチナ" {{ old('post.game_rank') == 'プラチナ' ? 'selected' : '' }}>プラチナ</option>
        <option value="ダイヤ" {{ old('post.game_rank') == 'ダイヤ' ? 'selected' : '' }}>ダイヤ</option>
        <option value="マスターorそれ以上" {{ old('post.game_rank') == 'マスターorそれ以上' ? 'selected' : '' }}>マスターorそれ以上</option>
        <option value="カジュアル" {{ old('post.game_rank') == 'カジュアル' ? 'selected' : '' }}>カジュアルで</option>
         </select>
       </div>
        <label for="voice_chat">ボイスチャット可否</label>
        <input type="checkbox" name="post[game_voice_chat]" id="voice_chat" value="1" {{ old('post.game_voice_chat') == 1 ? 'checked' : '' }}>
    </div>
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
           
            <input type="submit" value="決定する"/>
        
        </form>
                
    <div class="footer">
      <a href="/">戻る</a>
    </div>
  
    </body>
  </x-app-layout>
</html>