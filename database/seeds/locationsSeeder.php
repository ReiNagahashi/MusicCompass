<?php

use Illuminate\Database\Seeder;

class locationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            ['id' => 1, 'name' => 'コンサートホール'],
            ['id' => 2, 'name' => 'ライブハウス'],
            ['id' => 3, 'name' => 'クラブ'],
            ['id' => 4, 'name' => 'レストラン/バー'],
            ['id' => 5, 'name' => '学校'],
            ['id' => 6, 'name' => '野外'],
            ['id' => 7, 'name' => 'その他'],

        ];
        DB::table('locations')->insert($locations);
    }
}
