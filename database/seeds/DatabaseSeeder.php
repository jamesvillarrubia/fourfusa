<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    protected $tables = [
        'label_task',
        'labels',
        'tasks',
        'users'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->cleanDatabase();

        Model::unguard();
        

        $this->call('UserTableSeeder');
        $this->call('TaskTableSeeder');
        $this->call('LabelTableSeeder');
        $this->call('LabelTaskTableSeeder');

        Model::reguard();
    }


    private function cleanDatabase()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        
        foreach ($this->tables as $tableName)
        {

            DB::table($tableName)->truncate();

        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
