<?php

namespace developermarius\eventim\publicapi\models;

use utils\DataClass;

/**
 * @method EventimCategoryType getName()
 * @method EventimCategory|null getParentCategory()
 */
class EventimCategory extends DataClass{

    protected EventimCategoryType $name;
    protected ?EventimCategory $parent_category;

    public function __construct(array $data){
        $this->setProperties($data, array(
            'name' => EventimCategoryType::class,
            'parent_category' => EventimCategory::class
        ), array(
            'parentCategory' => 'parent_category'
        ));
    }
}