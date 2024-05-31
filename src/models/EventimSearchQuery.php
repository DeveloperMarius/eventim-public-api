<?php

namespace developermarius\eventim\publicapi\models;

class EventimSearchQuery{

    private string $webId = 'web__eventim-de';
    private ?string $search_term = null;
    private string $language = 'de';
    private int $page = 1;
    private ?string $retail_partner = null;
    private ?bool $in_stock = null;
    private ?array $tags = null;
    private ?array $city_names = null;
    /** @var EventimCategoryType[]|null $categories */
    private ?array $categories = null;
    private ?string $date_from = null;
    private ?string $date_to = null;
    private ?string $time_from = null;
    private ?string $time_to = null;
    private EventimSearchQuerySortBy $sort = EventimSearchQuerySortBy::RECOMMENDATION;
    private int $top = 50;

    public function webId(string $webId): EventimSearchQuery{
        $this->webId = $webId;
        return $this;
    }

    public function searchTerm(string $search_term): EventimSearchQuery{
        $this->search_term = $search_term;
        return $this;
    }

    public function language(string $language): EventimSearchQuery{
        $this->language = $language;
        return $this;
    }

    public function page(int $page): EventimSearchQuery{
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getPage(): int{
        return $this->page;
    }

    public function retailPartner(?string $retail_partner): EventimSearchQuery{
        $this->retail_partner = $retail_partner;
        return $this;
    }

    public function inStock(bool $in_stock): EventimSearchQuery{
        $this->in_stock = $in_stock;
        return $this;
    }

    public function tags(array $tags): EventimSearchQuery{
        $this->tags = $tags;
        return $this;
    }

    public function cityNames(array $city_names): EventimSearchQuery{
        $this->city_names = $city_names;
        return $this;
    }

    /**
     * @param EventimCategoryType[] $categories
     * @return $this
     */
    public function categories(array $categories): EventimSearchQuery{
        $this->categories = $categories;
        return $this;
    }

    public function dateFrom(string $date_from): EventimSearchQuery{
        $this->date_from = $date_from;
        return $this;
    }

    public function dateTo(string $date_to): EventimSearchQuery{
        $this->date_to = $date_to;
        return $this;
    }

    public function timeFrom(string $time_from): EventimSearchQuery{
        $this->time_from = $time_from;
        return $this;
    }

    public function timeTo(string $time_to): EventimSearchQuery{
        $this->time_to = $time_to;
        return $this;
    }

    public function sort(EventimSearchQuerySortBy $sort): EventimSearchQuery{
        $this->sort = $sort;
        return $this;
    }

    /**
     * @param int $top - Max 50
     */
    public function top(int $top): EventimSearchQuery{
        $this->top = $top;
        return $this;
    }

    public function toQueryArray(): array{
        $params = array(
            'webId' => $this->webId,
            'search_term' => $this->search_term,
            'language' => $this->language,
            'page' => $this->page,
            'retail_partner' => $this->retail_partner,
            'in_stock' => $this->in_stock,
            'tags' => $this->tags,
            'city_names' => $this->city_names,
            'categories' => $this->categories !== null ? array_map(fn($category) => ($category->getParent() !== null ? $category->getParent()->value . '|' : '') . $category->value, $this->categories) : null,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'time_from' => $this->time_from,
            'time_to' => $this->time_to,
            'sort' => $this->sort->value,
            'top' => $this->top
        );
        foreach($params as $key => $value){
            if($value === null){
                unset($params[$key]);
            }
        }
        return $params;
    }

    public function toQueryString(): string{
        $query_array = $this->toQueryArray();
        $segments = array();
        foreach($query_array as $key => $value){
            if(is_array($value)){
                foreach($value as $v){
                    $segments[] = $key . '=' . $v;
                }
            }else{
                $segments[] = $key . '=' . $value;
            }
        }
        return implode('&', $segments);
    }

    public static function new(): EventimSearchQuery{
        return new EventimSearchQuery();
    }
}