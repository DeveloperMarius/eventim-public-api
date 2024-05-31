<?php

namespace developermarius\eventim\publicapi\models;

use utils\DataClass;

/**
 * @method string getName()
 * @method string getCity()
 * @method EventimGeoLocation|null getGeoLocation()
 */
class EventimLocation extends DataClass{

    protected string $name;
    protected string $city;
    protected ?EventimGeoLocation $geo_location;

    public function __construct(array $data){
        $this->setProperties($data, array(
            'geo_location' => EventimGeoLocation::class,
        ), array(
            'geoLocation' => 'geo_location'
        ));
    }
}