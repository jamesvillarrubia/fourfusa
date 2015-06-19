<?php

namespace Helpers\Transformers;

class LabelTransformer extends Transformer {


    public function transform($labels)
    {

    	return [
    		'name' => $labels['name']
    	];
    }


}