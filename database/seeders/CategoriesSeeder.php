<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
class Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::table('categories')->insert([
                'name' =>'カテゴリー１',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
   ]);
}
}