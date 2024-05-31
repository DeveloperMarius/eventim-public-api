<?php

namespace developermarius\eventim\publicapi\models;

use utils\DataClass;

/**
 * @method EventimLiveEntertainment|null getLiveEntertainment()
 */
class EventimTypeAttributes extends DataClass{

    protected ?EventimLiveEntertainment $live_entertainment = null;

    public function __construct(array $data){
        $this->setProperties($data, array(
            'live_entertainment' => EventimLiveEntertainment::class,
        ), array(
            'liveEntertainment' => 'live_entertainment'
        ));
    }
}