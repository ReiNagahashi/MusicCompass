<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Profile;
// use App\Sex;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=>'Rei Nagahashi',
            'email'=>'Rei@gg.com',
            'password'=>bcrypt('password'),
        ]);

        $profile = Profile::create([
            'user_id'=>$user->id,
            'age'=>'21',
            'native'=>'東京',
            'favorite'=>'RadioFish',
            'interest'=>'ジャズ・ブルース',
            'avatar_image'=>'uploads/avatars/sampleForM.jpg',
            'intro'=>'自己紹介についてです okonanounoponyo',
        ]);

        // Sex::create([
        //     'profile_id'=>$profile->id,
        //     'num' => $sexes(0)
        // ]);

    }
}
