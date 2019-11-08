<?php

use Illuminate\Database\Seeder;

class HostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hosts = [
            ['id' => 1, 'name' => '旅人の宿泊を受け入れる'],
            ['id' => 2, 'name' => '現在は受け付けていない'],
        ];
        DB::table('hosts')->insert($hosts);
    }
}
