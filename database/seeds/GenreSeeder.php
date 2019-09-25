<?php

use Illuminate\Database\Seeder; 

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            ['id' => 1, 'name' => 'ジャズ/ブルース'],
            ['id' => 2, 'name' => 'ロック'],
            ['id' => 3, 'name' => 'オルタナティブ'],
            ['id' => 4, 'name' => 'レゲー'],
            ['id' => 5, 'name' => 'クラシック'],
            ['id' => 6, 'name' => 'ハードロック'],
            ['id' => 7, 'name' => 'メタル'],
            ['id' => 8, 'name' => 'EDM'],
            ['id' => 9, 'name' => 'ダンス'],
            ['id' => 10, 'name' => '民族音楽'],
            ['id' => 11, 'name' => 'その他'],

        ];
        DB::table('genres')->insert($genres);
    }
}
