<?php

namespace developermarius\eventim\publicapi\models;

use utils\DataClass;

/**
 * @method int getCount()
 * @method float getAverage()
 */
class EventimProductRating extends DataClass{

    protected int $count;
    protected float $average;

    public function __construct(array $data){
        $this->setProperties($data);
    }
}