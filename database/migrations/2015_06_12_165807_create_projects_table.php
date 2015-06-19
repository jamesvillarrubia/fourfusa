<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('projects', function(Blueprint $table){
            $table->increments('id'); //Unique project id.
            $table->timestamps();
            $table->integer('item_order'); //Project’s order in the project list. Smaller number should be located in the top.
            $table->integer('task_id')->unsigned();  //The id of the project you converted to
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
