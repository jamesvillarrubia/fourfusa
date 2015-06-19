<?php

namespace Helpers\Transformers;

class TaskTransformer extends Transformer {


    public function transform($tasks)
    {

        $tasks['isDone'] = (boolean) $tasks['isDone'];
        $tasks['collapsed'] = (boolean) $tasks['collapsed'];
        //$tasks['children'] = (@unserialize($tasks['children'])) ? unserialize($tasks['children']) : (array) $tasks['children'];
        //$tasks['labels'] = (@unserialize($tasks['labels']))  ? unserialize($tasks['labels']) : (array) $tasks['labels'];
        //$tasks['dependents'] = unserialize($tasks['dependents']);
        return $tasks;

    }


}