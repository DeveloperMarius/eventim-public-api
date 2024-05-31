<?php

namespace developermarius\eventim\publicapi\models;

use utils\DataClass;

/**
 * @method string getPath()
 * @method string getDomain()
 */
class EventimUrl extends DataClass{

    protected string $path;
    protected string $domain;

    public function __construct(array $data){
        $this->setProperties($data);
    }
}