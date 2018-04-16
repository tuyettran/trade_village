<?php

use Illuminate\Routing\Router;

$router->bind('news', function ($id) {
    return app('Modules\TradeVillage\Repositories\NewsRepository')->find($id);
});
$router->get('news','NewsController@list');
$router->get('news/{news}', 'NewsController@details');

$router->bind('events', function ($id) {
    return app('Modules\TradeVillage\Repositories\EventsRepository')->find($id);
});
$router->get('events','EventController@list');
$router->get('events/{events}', 'EventController@details');

$router->bind('artist', function ($id) {
    return app('Modules\TradeVillage\Repositories\ArtistRepository')->find($id);
});
$router->get('artists','ArtistController@list');
$router->get('artists/{artists}', 'ArtistController@details');

$router->bind('product', function ($id) {
    return app('Modules\TradeVillage\Repositories\ProductsRepository')->find($id);
});
$router->get('products','ProductController@list');
$router->get('products/{products}', 'ProductController@details');

$router->bind('villages', function ($id) {
    return app('Modules\TradeVillage\Repositories\VillagesRepository')->find($id);
});
$router->get('villages','VillageController@list');
$router->get('villages/{villages}', 'VillageController@details');