<?php

namespace developermarius\eventim\publicapi\models;

use utils\DataClass;

/**
 * @method float getLongitude()
 * @method float getLatitude()
 */
class EventimGeoLocation extends DataClass{

    protected float $longitude;
    protected float $latitude;

    public function __construct(array $data){
        $this->setProperties($data);
    }
}