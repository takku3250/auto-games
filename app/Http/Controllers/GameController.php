<?php

namespace App\Http\Controllers;

use App\Models\Game; // Gameモデルを使用するためにインポート
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        // すべてのゲームを取得してビューに渡す
        $games = Game::all();

        return view('games.index', ['games' => $games]);
    }

    public function show($id)
    {
        // 特定のゲームを取得してビューに渡す
        $game = Game::find($id);

        return view('games.show', ['games' => $game]);
    }
}