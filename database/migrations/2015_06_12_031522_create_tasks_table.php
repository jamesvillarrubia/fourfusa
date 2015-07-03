<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('tasks', function(Blueprint $table){
            $table->increments('id'); //Unique task id.
            $table->timestamps();
            $table->string('title');
            $table->boolean('isDone'); //Completeion
            //in_history  If set to 1, the task is marked completed.
            $table->integer('user_id')->unsigned(); //The owner of the task.
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('content');  //Content of the text
            $table->string('date_string'); //The date of the task, added in free form text, for example it can be every day @ 10. Look at our reference to see which formats are supported.
            $table->string('date_lang');//   The language of the date_string.
            $table->string('due_date_utc'); // Should be formatted as YYYY-MM-DDTHH:MM, example: 2012-3-24T23:59. Value of due_date_utc must be in UTC. If you want to pass in due dates, note that date_string is required, while due_date_utc can be omitted. If date_string is provided, it will be parsed as local timestamp, and converted to UTC internally, according to the user’s profile settings.
            $table->string('start_date_utc'); // Should be formatted as YYYY-MM-DDTHH:MM, example: 2012-3-24T23:59. Value of due_date_utc must be in UTC. If you want to pass in due dates, note that date_string is required, while due_date_utc can be omitted. If date_string is provided, it will be parsed as local timestamp, and converted to UTC internally, according to the user’s profile settings.
            $table->boolean('collapsed'); //If set to 1 the task’s sub tasks are collapsed. Otherwise they aren’t.
            $table->integer('priority');  //The priority of the task (a number between 1 and 4, 4 for very urgent and 1 for natural).
            $table->integer('order'); //The order of the task.
            $table->integer('parent');//The tasks child tasks (a list of task ids such as [13134,232345]).
            $table->integer('assigned_by_uid'); //The id of user who assigns current task. Makes sense for shared projects only. Accepts 0 or any user id from the list of project collaborators. If this value is unset or invalid, it will automatically be set up by your uid.
            $table->integer('responsible_uid'); //The id of user who is responsible for accomplishing the current task. Makes sense for shared projects only. Accepts 0 or any user id from the list of project collaborators. If this value is unset or invalid, it will automatically be set up by null.
            $table->string('color_hex'); //hexcode of the color of this group
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
