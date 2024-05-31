<?php

namespace developermarius\eventim\publicapi\models;

use utils\DataClass;

/**
 * @method string getName()
 */
class EventimAttraction extends DataClass{

    protected string $name;

    public function __construct(array $data){
        $this->setProperties($data);
    }
}