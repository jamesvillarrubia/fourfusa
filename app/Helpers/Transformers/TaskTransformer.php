<?php

namespace Helpers\Transformers;

class TaskTransformer extends Transformer {


    public function transform($task)
    {

        $task['isDone'] = ($task['isDone'])? '1':'0';
        $task['collapsed'] = ($task['collapsed'])? '1':'0';
        //$tasks['children'] = (@unserialize($tasks['children'])) ? unserialize($tasks['children']) : (array) $tasks['children'];
        //$tasks['labels'] = (@unserialize($tasks['labels']))  ? unserialize($tasks['labels']) : (array) $tasks['labels'];
        //$tasks['dependents'] = unserialize($tasks['dependents']);
        

        

        $newtask = [
	        'title' => '',
	        'isDone' => 0,
	        'user_id' => 1,
	        'content' => '',
	        'date_string'=> '',
	        'date_lang' => 'en',
	        'due_date_utc' => '',
	        'start_date_utc' => '',
	        'collapsed' => '0',
	        'priority' => '0',
	 		'order' => '',
	 		'parent' =>  '0',
	 		'assigned_by_uid' => '',
			'responsible_uid' => '',
	        'color_hex' => '00aef3'
        ];

		$newtask = array_merge($newtask, $task);

        return $task;

    }

    public function reverse($task){




    	return $task;
    }


}