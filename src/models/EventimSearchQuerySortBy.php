<?php

namespace developermarius\eventim\publicapi\models;

enum EventimSearchQuerySortBy: string{

    case RECOMMENDATION = 'Recommendation';
    case NAME_ASC = 'NameAsc';
    case RATING = 'Rating';
    case DATE_ASC = 'DateAsc';

}