<?php

namespace developermarius\eventim\publicapi\models;

use utils\DataClass;
use utils\Time;

/**
 * @method Time|null getStartDate()
 * @method EventimLocation getLocation()
 */
class EventimLiveEntertainment extends DataClass{

    protected ?Time $start_date;
    protected EventimLocation $location;

    public function __construct(array $data){
        $this->setProperties($data, array(
            'start_date' => Time::class,
            'location' => EventimLocation::class,
        ), array(
            'startDate' => 'start_date',
        ));
    }
}