<?php

use Illuminate\Database\Seeder;

class ProfileSeeder  extends Seeder
{
    public function run()
    {
        factory(App\Capstone\User\Model\User::class, 100)->create()->each(function($u) {
            $u->profile()->create(factory(App\Capstone\Profile\Model\Profile::class)->make());
//            $u->posts()->save(factory(App\Post::class)->make());
        });
    }
}