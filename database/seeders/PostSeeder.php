<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
                'user_id' => 1,
                'category_id' => 1, 
                'title' => '募集作成',
                'body' => 'ランクorカジュアル',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
     ]);
}
}