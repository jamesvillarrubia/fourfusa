<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Label;

class LabelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Label',10)->create();
    }
}
