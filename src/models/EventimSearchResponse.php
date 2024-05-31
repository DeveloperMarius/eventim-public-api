<?php

namespace developermarius\eventim\publicapi\models;

use utils\DataClass;

/**
 * @method EventimProduct[] getProducts()
 * @method array getFacets()
 * @method int getResults()
 * @method int getTotalResults()
 * @method int getPage()
 * @method int getTotalPages()
 */
class EventimSearchResponse extends DataClass{

    protected array $products;
    protected array $facets;
    protected int $results;
    protected int $total_results;
    protected int $page;
    protected int $total_pages;

    public function __construct(array $data){
        $this->setProperties($data, array(
            'products' => EventimProduct::class,
        ), array(
            'totalResults' => 'total_results',
            'totalPages' => 'total_pages',
        ));
    }
}