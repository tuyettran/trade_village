<?php 
use Illuminate\Routing\Router;
/** @var Router $router */
$router->group(['prefix' =>'/tradevillage'], function (Router $router) {
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
    $router->bind('process', function ($id) {
        return app('Modules\TradeVillage\Repositories\ProcessRepository')->find($id);
    });
    $router->get('processes', [
        'as' => 'frontend.tradevillage.process.index',
        'uses' => 'FrontendProcessController@index'
    ]);
    $router->get('processes/create', [
        'as' => 'frontend.tradevillage.process.create',
        'uses' => 'FrontendProcessController@create',
        'middleware' => 'can:tradevillage.processes.create'
    ]);
    $router->post('processes', [
        'as' => 'frontend.tradevillage.process.store',
        'uses' => 'FrontendProcessController@store',
        'middleware' => 'can:tradevillage.processes.create'
    ]);
    $router->get('processes/{process}/edit', [
        'as' => 'frontend.tradevillage.process.edit',
        'uses' => 'FrontendProcessController@edit',
        'middleware' => 'can:tradevillage.processes.edit'
    ]);
    $router->put('processes/{process}', [
        'as' => 'frontend.tradevillage.process.update',
        'uses' => 'FrontendProcessController@update',
        'middleware' => 'can:tradevillage.processes.edit'
    ]);
    $router->delete('processes/{process}', [
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
    $router->get('product/{product}', [
        'as' => 'frontend.tradevillage.products.show',
        'uses' => 'FrontendProductController@show'
    ]);
    $router->get('products/create', [
        'as' => 'frontend.tradevillage.products.create',
        'uses' => 'FrontendProductController@create',
        'middleware' => 'can:tradevillage.products.create'
    ]);
    $router->get('product/{product}/model', [
        'as' => 'frontend.tradevillage.products.model',
        'uses' => 'FrontendProductController@model',
        'middleware' => 'can:tradevillage.products.index'
    ]);
    $router->post('products', [
        'as' => 'frontend.tradevillage.products.store',
        'uses' => 'FrontendProductController@store',
        'middleware' => 'can:tradevillage.products.create'
    ]);
    $router->get('product/{product}/edit', [
        'as' => 'frontend.tradevillage.products.edit',
        'uses' => 'FrontendProductController@edit',
        'middleware' => 'can:tradevillage.products.edit'
    ]);
    $router->put('product/{product}', [
        'as' => 'frontend.tradevillage.products.update',
        'uses' => 'FrontendProductController@update',
        'middleware' => 'can:tradevillage.products.edit'
    ]);
    $router->delete('product/{product}', [
        'as' => 'frontend.tradevillage.products.destroy',
        'uses' => 'FrontendProductController@destroy',
        'middleware' => 'can:tradevillage.products.destroy'
    ]);

    $router->bind('villages', function ($id) {
        return app('Modules\TradeVillage\Repositories\VillagesRepository')->find($id);
    });
    $router->get('villages', [
        'as' => 'frontend.tradevillage.villages.index',
        'uses' => 'FrontendVillagesController@index'
    ]);
    $router->get('villages/{village}', [
        'as' => 'frontend.tradevillage.villages.show',
        'uses' => 'FrontendVillagesController@show'
    ]);
    $router->get('villages/{villages}/xml-generate', [
        'as' => 'frontend.tradevillage.villages.xmlGenerate',
        'uses' => 'FrontendVillagesController@xmlGenerate'
    ]);
});
?>