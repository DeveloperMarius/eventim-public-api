# Eventim Public Api

This is a simple wrapper for the Eventim Public Api. It is written in PHP and provides a simple way to access the Eventim Public Api.  
The Eventim Public Api is a RESTful API that provides access to the Eventim products through its search functionality.  
After I did some simple analysis on the Eventim Public Api, I documented some components of the API in a gist. You can find the gist [here](https://gist.github.com/DeveloperMarius/7e8aff4c69ccbf59238d76163c86d9c9).

> **Disclaimer** before using this client: please ensure that you have the permissions from the Website Owner.

## Installation

To install this library, you need to have Composer installed on your system. If you don't have it installed, you can download it from [here](https://getcomposer.org/).

Once you have Composer installed, you can install the library by running the following command in your terminal:

```bash
composer require developermarius/eventim-public-api
```

## Usage

### Initialization

First, you need to import the `EventimClient` class and create a new instance of it.

```php
use developermarius\eventim\publicapi\EventimClient;

$client = new EventimClient();
```

### Searching for Products

To search for products, you can use the `search` method. This method accepts an optional `EventimSearchQuery` object. If no query object is provided, a default one will be used.

```php
use developermarius\eventim\publicapi\models\EventimSearchQuery;

$query = EventimSearchQuery::new()->categories(array(
    EventimCategoryType::HUMOR,
    EventimCategoryType::CONCERT
))->cityNames(array(
    'Frankfurt am Main'
));

$response = $client->search($query);
```

The `search` method returns an `EventimSearchResponse` object, which contains the search results.

### Paginating Search Results

To paginate through search results, you can use the `paginateSearch` method. This method accepts a callback function, an optional `EventimSearchQuery` object, and an optional sleep time between requests.

```php
$allProducts = $client->paginateSearch(function($response) {
    // Process each page of results here
}, $query, 2);
```

## Limitations

Please note that due to limitations on the Eventim side, this library cannot handle page numbers greater than 102. If you try to access a page number greater than 102, an exception will be thrown.

## Contributing

Contributions are welcome! Please feel free to submit a pull request.

## License

This library is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
