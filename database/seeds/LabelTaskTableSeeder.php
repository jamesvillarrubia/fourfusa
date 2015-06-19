<?php

use Illuminate\Database\Seeder;
use App\Task;
use App\Label;

class LabelTaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$faker = Faker\Factory::create();

    	$taskIds = Task::lists('id')->toArray();
    	$labelIds = Label::lists('id')->toArray();

    	foreach(range(1,50) as $index)
    	{

    		DB::table('label_task')->insert([
    			'label_id' => $faker->randomElement($labelIds),
    			'task_id' => $faker->randomElement($taskIds)
    		]);

    	}

    }
}
