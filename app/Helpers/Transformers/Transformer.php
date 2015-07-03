<?php

namespace Helpers\Transformers;

abstract class Transformer {
	
    public function transformCollection($items)
    {
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);

    public function reverseCollection($items)
    {
        return array_map([$this, 'reverse'], $items);
    }

    public abstract function reverse($item);
	
}