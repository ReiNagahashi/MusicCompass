<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        // $this->call(PostsSeeder::class);
        //  $this->call(prefecture_locationSeeder::class);
         $this->call(PrefectureSeeder::class);
        //  $this->call(SexSeeder::class);
        //  $this->call(GenreSeeder::class);


    }
}
