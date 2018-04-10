<?php 
use Illuminate\Routing\Router;
/** @var Router $router */
$router->group(['prefix' =>'/tradevillage'], function (Router $router) {
// education routes
    $router->group(['prefix' =>'/education'], function (Router $router) {
        $router->bind('documents', function ($id) {
            return app('Modules\TradeVillage\Repositories\DocumentsRepository')->find($id);
        });
        $router->get('document/{document}', [
            'as' => 'frontend.tradevillage.course.documents.show',
            'uses' => 'FrontendDocumentController@show',
            'middleware' => 'can:tradevillage.documents.index'
        ]);
        $router->bind('video', function ($id) {
            return app('Modules\TradeVillage\Repositories\VideoRepository')->find($id);
        });
        $router->get('videos', [
            'as' => 'frontend.tradevillage.video.index',
            'uses' => 'FrontendVideoController@index',
            'middleware' => 'can:tradevillage.videos.index'
        ]);
        $router->bind('course_users', function ($id) {
            return app('Modules\TradeVillage\Repositories\Course_usersRepository')->find($id);
        });
        $router->get('course_users', [
            'as' => 'frontend.tradevillage.course_users.index',
            'uses' => 'FrontendCourse_usersController@index',
            'middleware' => 'can:tradevillage.course_users.index'
        ]);
        $router->get('course_users/create', [
            'as' => 'frontend.tradevillage.course_users.create',
            'uses' => 'FrontendCourse_usersController@create',
            'middleware' => 'can:tradevillage.course_users.create'
        ]);
        $router->post('course_users', [
            'as' => 'frontend.tradevillage.course_users.store',
            'uses' => 'FrontendCourse_usersController@store',
            'middleware' => 'can:tradevillage.course_users.create'
        ]);
        $router->delete('course_users/{course_users}', [
            'as' => 'frontend.tradevillage.course_users.destroy',
            'uses' => 'FrontendCourse_usersController@destroy',
            'middleware' => 'can:tradevillage.course_users.destroy'
        ]);
    });
    $router->bind('processes', function ($id) {
        return app('Modules\TradeVillage\Repositories\ProcessRepository')->find($id);
    });


//village routes
    $router->get('product/{product}/processes', [
        'as' => 'frontend.tradevillage.products.processes',
        'uses' => 'FrontendProcessController@process'
    ]);
    $router->post('{product}/processes', [
        'as' => 'frontend.tradevillage.process.store',
        'uses' => 'FrontendProcessController@store',
        'middleware' => 'can:tradevillage.processes.create'
    ]);
    $router->get('processes/{process}/{product}/edit', [
        'as' => 'frontend.tradevillage.process.edit',
        'uses' => 'FrontendProcessController@edit',
        'middleware' => 'can:tradevillage.processes.edit'
    ]);
    $router->put('processes/{process}/{product}', [
        'as' => 'frontend.tradevillage.process.update',
        'uses' => 'FrontendProcessController@update',
        'middleware' => 'can:tradevillage.processes.edit'
    ]);
    $router->delete('processes/{process}/{product}', [
        'as' => 'frontend.tradevillage.process.destroy',
        'uses' => 'FrontendProcessController@destroy',
        'middleware' => 'can:tradevillage.processes.destroy'
    ]);
    $router->bind('artist', function ($id) {
        return app('Modules\TradeVillage\Repositories\ArtistRepository')->find($id);
    });
    $router->get('artists', [
        'as' => 'frontend.tradevillage.artist.index',
        'uses' => 'FrontendArtistController@index'
    ]);
    $router->get('artists/{artist}', [
        'as' => 'frontend.tradevillage.artist.show',
        'uses' => 'FrontendArtistController@show'
    ]);
    $router->bind('enterprises', function ($id) {
        return app('Modules\TradeVillage\Repositories\EnterprisesRepository')->find($id);
    });
    $router->get('enterprises', [
        'as' => 'frontend.tradevillage.enterprises.index',
        'uses' => 'FrontendEnterpriseController@index'
    ]);
    $router->get('enterprises/{enterprise}', [
        'as' => 'frontend.tradevillage.enterprises.show',
        'uses' => 'FrontendEnterpriseController@show'
    ]);
    $router->bind('events', function ($id) {
        return app('Modules\TradeVillage\Repositories\EventsRepository')->find($id);
    });
    $router->get('events', [
        'as' => 'frontend.tradevillage.events.index',
        'uses' => 'FrontendEventController@index'
    ]);
    $router->get('events/{event}', [
        'as' => 'frontend.tradevillage.events.show',
        'uses' => 'FrontendEventController@show'
    ]);


// product routes
    $router->bind('product', function ($id) {
        return app('Modules\TradeVillage\Repositories\ProductsRepository')->find($id);
    });
    $router->get('products', [
        'as' => 'frontend.tradevillage.products.index',
        'uses' => 'FrontendProductController@index'
    ]);
    $router->get('user/{user_id}/products', [
        'as' => 'frontend.tradevillage.products.user_products',
        'uses' => 'FrontendProductController@user_products'
    ]);
    $router->get('products/create', [
        'as' => 'frontend.tradevillage.products.create',
        'uses' => 'FrontendProductController@create',
        'middleware' => 'can:tradevillage.products.create'
    ]);

    $router->post('products', [
        'as' => 'frontend.tradevillage.products.store',
        'uses' => 'FrontendProductController@store',
        'middleware' => 'can:tradevillage.products.create'
    ]);

    $router->delete('products/comment',[
        'as' => 'frontend.tradevillage.products.deleteComment',
        'uses' => 'FrontendProductController@deleteComment',
        'middleware' => 'logged.in'
    ]);
    $router->group(['prefix' =>'product/{product}'], function (Router $router) {
        $router->get('model', [
            'as' => 'frontend.tradevillage.products.model',
            'uses' => 'FrontendProductController@model',
            'middleware' => 'logged.in'
        ]);
        $router->get('/', [
            'as' => 'frontend.tradevillage.products.show',
            'uses' => 'FrontendProductController@show'
        ]);
        $router->get('edit', [
            'as' => 'frontend.tradevillage.products.edit',
            'uses' => 'FrontendProductController@edit',
            'middleware' => 'can:tradevillage.products.edit'
        ]);
        $router->put('/', [
            'as' => 'frontend.tradevillage.products.update',
            'uses' => 'FrontendProductController@update',
            'middleware' => 'can:tradevillage.products.edit'
        ]);
        $router->delete('/', [
            'as' => 'frontend.tradevillage.products.destroy',
            'uses' => 'FrontendProductController@destroy',
            'middleware' => 'can:tradevillage.products.destroy'
        ]);
        $router->post('rate', [
            'as' => 'frontend.tradevillage.products.rate',
            'uses' => 'FrontendProductController@rate',
            'middleware' => 'logged.in'
        ]);

        $router->post('comment', [
            'as' => 'frontend.tradevillage.products.comment',
            'uses' => 'FrontendProductController@comment',
            'middleware' => 'logged.in'
        ]);
    });


//village routes
    $router->bind('villages', function ($id) {
        return app('Modules\TradeVillage\Repositories\VillagesRepository')->find($id);
    });
    $router->get('villages', [
        'as' => 'frontend.tradevillage.villages.index',
        'uses' => 'FrontendVillagesController@index'
    ]);
    $router->get('all-villages', [
        'as' => 'frontend.tradevillage.villages.allVillages',
        'uses' => 'FrontendVillagesController@getAllVillages'
    ]);
    $router->get('active-villages', [
        'as' => 'frontend.tradevillage.villages.activeVillages',
        'uses' => 'FrontendVillagesController@getAllActiveVillages'
    ]);

    $router->group(['prefix' =>'villages/{village}'], function (Router $router) {
        $router->get('/', [
            'as' => 'frontend.tradevillage.villages.show',
            'uses' => 'FrontendVillagesController@show'
        ]);
        $router->get('xml-generate', [
            'as' => 'frontend.tradevillage.villages.xmlGenerate',
            'uses' => 'FrontendVillagesController@xmlGenerate'
        ]);
        $router->get('enterprises', [
            'as' => 'frontend.tradevillage.villages.enterprises',
            'uses' => 'FrontendVillagesController@enterprises'
        ]);
        $router->get('artists', [
            'as' => 'frontend.tradevillage.villages.artists',
            'uses' => 'FrontendVillagesController@artists'
        ]);
        $router->get('products', [
            'as' => 'frontend.tradevillage.villages.products',
            'uses' => 'FrontendVillagesController@products'
        ]);
        $router->get('news', [
            'as' => 'frontend.tradevillage.villages.news',
            'uses' => 'FrontendVillagesController@news'
        ]);
        $router->get('events', [
            'as' => 'frontend.tradevillage.villages.events',
            'uses' => 'FrontendVillagesController@events'
        ]);
    });
    $router->bind('news', function ($id) {
        return app('Modules\TradeVillage\Repositories\NewsRepository')->find($id);
    });
    $router->get('news', [
        'as' => 'frontend.tradevillage.news.index',
        'uses' => 'FrontendNewsController@index'
    ]);
    $router->get('news/{news}', [
        'as' => 'frontend.tradevillage.news.show',
        'uses' => 'FrontendNewsController@show'
    ]);


//search route
    $router->get('search', [
        'as' => 'frontend.tradevillage.search',
        'uses' => 'FrontendSearchController@home'
    ]);
    $router->get('artist/search', [
        'as' => 'frontend.tradevillage.search.artist',
        'uses' => 'FrontendSearchController@artist'
    ]);
    $router->get('artist/category', [
        'as' => 'frontend.tradevillage.search.artist.category',
        'uses' => 'FrontendSearchController@artist_by_category'
    ]);
    $router->get('event/search', [
        'as' => 'frontend.tradevillage.search.event',
        'uses' => 'FrontendSearchController@event'
    ]);
    $router->get('new/search', [
        'as' => 'frontend.tradevillage.search.new',
        'uses' => 'FrontendSearchController@new'
    ]);
    $router->get('enterprise/search', [
        'as' => 'frontend.tradevillage.search.enterprise',
        'uses' => 'FrontendSearchController@enterprise'
    ]);
    $router->get('enterprise/category', [
        'as' => 'frontend.tradevillage.search.enterprise.category',
        'uses' => 'FrontendSearchController@enterprise_by_category'
    ]);
    $router->get('products/search', [
        'as' => 'frontend.tradevillage.search.product',
        'uses' => 'FrontendSearchController@product'
    ]);
});
?>