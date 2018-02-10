<?php 
use Illuminate\Routing\Router;
/** @var Router $router */
$router->group(['prefix' =>'/tradevillage'], function (Router $router) {
    $router->bind('documents', function ($id) {
        return app('Modules\TradeVillage\Repositories\DocumentsRepository')->find($id);
    });
    $router->get('documents', [
        'as' => 'frontend.tradevillage.documents.index',
        'uses' => 'FrontendDocumentController@index',
        'middleware' => 'can:tradevillage.documents.index'
    ]);
    $router->bind('process', function ($id) {
        return app('Modules\TradeVillage\Repositories\ProcessRepository')->find($id);
    });
    $router->get('processes', [
        'as' => 'admin.tradevillage.process.index',
        'uses' => 'FrontendProcessController@index',
        'middleware' => 'can:tradevillage.processes.index'
    ]);
    $router->get('processes/create', [
        'as' => 'admin.tradevillage.process.create',
        'uses' => 'FrontendProcessController@create',
        'middleware' => 'can:tradevillage.processes.create'
    ]);
    $router->post('processes', [
        'as' => 'admin.tradevillage.process.store',
        'uses' => 'FrontendProcessController@store',
        'middleware' => 'can:tradevillage.processes.create'
    ]);
    $router->get('processes/{process}/edit', [
        'as' => 'admin.tradevillage.process.edit',
        'uses' => 'FrontendProcessController@edit',
        'middleware' => 'can:tradevillage.processes.edit'
    ]);
    $router->put('processes/{process}', [
        'as' => 'admin.tradevillage.process.update',
        'uses' => 'FrontendProcessController@update',
        'middleware' => 'can:tradevillage.processes.edit'
    ]);
    $router->delete('processes/{process}', [
        'as' => 'admin.tradevillage.process.destroy',
        'uses' => 'FrontendProcessController@destroy',
        'middleware' => 'can:tradevillage.processes.destroy'
    ]);
    $router->bind('video', function ($id) {
        return app('Modules\TradeVillage\Repositories\VideoRepository')->find($id);
    });
    $router->get('videos', [
        'as' => 'admin.tradevillage.video.index',
        'uses' => 'FrontendVideoController@index',
        'middleware' => 'can:tradevillage.videos.index'
    ]);
    $router->bind('course_users', function ($id) {
        return app('Modules\TradeVillage\Repositories\Course_usersRepository')->find($id);
    });
    $router->get('course_users', [
        'as' => 'admin.tradevillage.course_users.index',
        'uses' => 'FrontendCourse_usersController@index',
        'middleware' => 'can:tradevillage.course_users.index'
    ]);
    $router->get('course_users/create', [
        'as' => 'admin.tradevillage.course_users.create',
        'uses' => 'FrontendCourse_usersController@create',
        'middleware' => 'can:tradevillage.course_users.create'
    ]);
    $router->post('course_users', [
        'as' => 'admin.tradevillage.course_users.store',
        'uses' => 'FrontendCourse_usersController@store',
        'middleware' => 'can:tradevillage.course_users.create'
    ]);
    $router->delete('course_users/{course_users}', [
        'as' => 'admin.tradevillage.course_users.destroy',
        'uses' => 'FrontendCourse_usersController@destroy',
        'middleware' => 'can:tradevillage.course_users.destroy'
    ]);
    $router->bind('artist', function ($id) {
        return app('Modules\TradeVillage\Repositories\ArtistRepository')->find($id);
    });
    $router->get('artists', [
        'as' => 'admin.tradevillage.artist.index',
        'uses' => 'FrontendArtistController@index',
        'middleware' => 'can:tradevillage.artists.index'
    ]);
    $router->bind('events', function ($id) {
        return app('Modules\TradeVillage\Repositories\EventsRepository')->find($id);
    });
    $router->get('events', [
        'as' => 'admin.tradevillage.events.index',
        'uses' => 'FrontendEventController@index',
        'middleware' => 'can:tradevillage.events.index'
    ]);
    $router->bind('products', function ($id) {
        return app('Modules\TradeVillage\Repositories\ProductsRepository')->find($id);
    });
    $router->get('products', [
        'as' => 'admin.tradevillage.products.index',
        'uses' => 'FrontendProductController@index',
        'middleware' => 'can:tradevillage.products.index'
    ]);
});
?>