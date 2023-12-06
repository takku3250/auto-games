<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
      public function run()
    {
     //　複数のゲームデータを配列として定義
      $gamesData = [
            [
                'title' => 'APEX Legends',
                'genre' => 'アクション',
                'platforms' => 'PC, PlayStation,Xbox,Switch',
                "mode"=>"カジュアル,ランク,射撃訓練場,イベント",
                "rank"=>"認定マッチ、ルーキー、ブロンズ、シルバー、ゴールド、プラチナ、ダイヤ、マスター、プレデター",
                "playstyle"=>"エンジョイ,ガチ,順位優先,キルムーブ",
                "body"=>"例）どなたでも大歓迎です！！",
                'created_at' => now(),
                 'updated_at' => now(),

                ],
            [
                'title' => 'VALORANT',
                'genre' => 'アクション',
                'platforms' => 'PC',
                "rank"=> "アイアン,ブロンズ、シルバー、ゴールド、プラチナ、ダイヤ、アセンダント、イモータル、レディアント"],
                "playstyle"=>"エンジョイ、ガチ、こだわらない",
                "body"=>"例)どなたでも大歓迎です",
                'created_at' => now(),
                'updated_at' => now(),
        ];
         // データを挿入
         foreach ($gamesData as $data){
             DB::table("games")->insert($data);
         }
  }
}
