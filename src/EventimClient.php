<?php

namespace developermarius\eventim\publicapi;

use developermarius\eventim\publicapi\models\EventimSearchQuery;
use developermarius\eventim\publicapi\models\EventimSearchResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;

class EventimClient{

    private ?Client $http_client = null;

    private static array $user_agents = array(
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.3729.169 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36',
        'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
    );

    private function getHttpClient(): Client{
        if($this->http_client === null){
            $stack = new HandlerStack();
            $stack->setHandler(new CurlHandler());
            $stack->push(Middleware::mapRequest(function(RequestInterface $request) {
                //Eventim blocks my User-Agents, why??
                //The default "GuzzleHttp/7" works...
                //$request = $request->withHeader('User-Agent', EventimClient::$user_agents[array_rand(EventimClient::$user_agents)]);
                return $request;
            }));
            $this->http_client = new Client(array(
                'headers' => array(
                    'Referer' => 'https://www.eventim.de/'
                ),
                'base_uri' => 'https://public-api.eventim.com',
                'handler' => $stack
            ));
        }
        return $this->http_client;
    }

    public function paginateSearch(callable $callback, ?EventimSearchQuery $query = null, int $sleep = 2): array{
        $query = $query ?? new EventimSearchQuery();
        $current_page = $query->getPage();
        $total_pages = null;
        $all_products = array();
        while($total_pages === null || $current_page <= min($total_pages, 102)){
            if($sleep > 0)
                sleep($sleep);
            $query->page($current_page);
            $response = $this->search($query);
            $total_pages = $response->getTotalPages();
            $callback($response);
            $all_products = array_merge($all_products, $response->getProducts());
            $current_page++;
        }
        return $all_products;
    }

    public function search(?EventimSearchQuery $query = null): EventimSearchResponse{
        $query = $query ?? new EventimSearchQuery();
        /*
         * In my tests Eventim cannot handle page > 102
         * Error page 103: {"status":"INTERNAL_SERVER_ERROR","timestamp":"29-05-2024 12:39:13","message":"","debugMessage":""}
         * Error page 104: {"status":"BAD_REQUEST","timestamp":"29-05-2024 12:39:24","message":"Invalid search parameter","debugMessage":"Page size must not be less than one"}
         * Error page 105: {"status":"BAD_REQUEST","timestamp":"29-05-2024 12:39:24","message":"Invalid search parameter","debugMessage":"Page size must not be less than one"}
         * ...
         *
         * Probably some kind of int overflow?? Wtf...
         */
        if($query->getPage() > 102)
            throw new \Exception('Eventim cannot handle page > 102');
        $response = $this->getHttpClient()->request('GET', '/websearch/search/api/exploration/v1/products', array(
            'query' => $query->toQueryString()
        ));
        if($response->getStatusCode() !== 200)
            throw new \Exception('Eventim returned status code ' . $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        return new EventimSearchResponse($data);
    }
}