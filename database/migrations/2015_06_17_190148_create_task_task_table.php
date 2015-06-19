<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_task', function (Blueprint $table) {
            $table->increments('id'); //Unique task id.
            $table->integer('parent_id')->unsigned()->index();
            $table->foreign('parent_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->integer('child_id')->unsigned()->index();
            $table->foreign('child_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('task_task');
    }
}
