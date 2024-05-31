<?php

namespace developermarius\eventim\publicapi\models;

enum EventimProductStatus: string{

    case AVAILABLE = 'Available';
    case SOLD_OUT = 'SoldOut';
    case CANCELLED = 'Cancelled';

}