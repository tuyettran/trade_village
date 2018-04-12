<?php

use Illuminate\Routing\Router;

$router->bind('news', function ($id) {
    return app('Modules\TradeVillage\Repositories\NewsRepository')->find($id);
});
$router->get('news','NewsController@list');
$router->get('news/{news}', 'NewsController@details');