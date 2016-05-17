<?php

use Illuminate\Database\Seeder;

class Test extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Capstone\User\Model\User::class, 100)->create()->each(function($u) {
            $u->profile()->save(factory(App\Capstone\Profile\Model\Profile::class)->make());
            $u->profile->postcodeInfo()->save(factory(App\Capstone\Postcode\Model\Postcode::class)->make());
        });
    }
}
