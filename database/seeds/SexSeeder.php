<?php

use Illuminate\Database\Seeder;
use App\Sex;

class SexSeeder extends Seeder
{
    /**　
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sexes = [
            ['id' => 1, 'sex' => '♂'],
            ['id' => 2, 'sex' => '♀'],
            ['id' => 3, 'sex' => 'その他']
        ];
        DB::table('sexes')->insert($sexes);

    } 
}
