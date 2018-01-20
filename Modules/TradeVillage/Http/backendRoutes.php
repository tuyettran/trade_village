<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/tradevillage'], function (Router $router) {
    $router->bind('villages', function ($id) {
        return app('Modules\TradeVillage\Repositories\VillagesRepository')->find($id);
    });
    $router->get('villages', [
        'as' => 'admin.tradevillage.villages.index',
        'uses' => 'VillagesController@index',
        'middleware' => 'can:tradevillage.villages.index'
    ]);
    $router->get('villages/create', [
        'as' => 'admin.tradevillage.villages.create',
        'uses' => 'VillagesController@create',
        'middleware' => 'can:tradevillage.villages.create'
    ]);
    $router->post('villages', [
        'as' => 'admin.tradevillage.villages.store',
        'uses' => 'VillagesController@store',
        'middleware' => 'can:tradevillage.villages.create'
    ]);
    $router->get('villages/{villages}/edit', [
        'as' => 'admin.tradevillage.villages.edit',
        'uses' => 'VillagesController@edit',
        'middleware' => 'can:tradevillage.villages.edit'
    ]);
    $router->put('villages/{villages}', [
        'as' => 'admin.tradevillage.villages.update',
        'uses' => 'VillagesController@update',
        'middleware' => 'can:tradevillage.villages.edit'
    ]);
    $router->delete('villages/{villages}', [
        'as' => 'admin.tradevillage.villages.destroy',
        'uses' => 'VillagesController@destroy',
        'middleware' => 'can:tradevillage.villages.destroy'
    ]);
    $router->bind('enterprises', function ($id) {
        return app('Modules\TradeVillage\Repositories\EnterprisesRepository')->find($id);
    });
    $router->get('enterprises', [
        'as' => 'admin.tradevillage.enterprises.index',
        'uses' => 'EnterprisesController@index',
        'middleware' => 'can:tradevillage.enterprises.index'
    ]);
    $router->get('enterprises/create', [
        'as' => 'admin.tradevillage.enterprises.create',
        'uses' => 'EnterprisesController@create',
        'middleware' => 'can:tradevillage.enterprises.create'
    ]);
    $router->post('enterprises', [
        'as' => 'admin.tradevillage.enterprises.store',
        'uses' => 'EnterprisesController@store',
        'middleware' => 'can:tradevillage.enterprises.create'
    ]);
    $router->get('enterprises/{enterprises}/edit', [
        'as' => 'admin.tradevillage.enterprises.edit',
        'uses' => 'EnterprisesController@edit',
        'middleware' => 'can:tradevillage.enterprises.edit'
    ]);
    $router->put('enterprises/{enterprises}', [
        'as' => 'admin.tradevillage.enterprises.update',
        'uses' => 'EnterprisesController@update',
        'middleware' => 'can:tradevillage.enterprises.edit'
    ]);
    $router->delete('enterprises/{enterprises}', [
        'as' => 'admin.tradevillage.enterprises.destroy',
        'uses' => 'EnterprisesController@destroy',
        'middleware' => 'can:tradevillage.enterprises.destroy'
    ]);
    $router->bind('news', function ($id) {
        return app('Modules\TradeVillage\Repositories\NewsRepository')->find($id);
    });
    $router->get('news', [
        'as' => 'admin.tradevillage.news.index',
        'uses' => 'NewsController@index',
        'middleware' => 'can:tradevillage.news.index'
    ]);
    $router->get('news/create', [
        'as' => 'admin.tradevillage.news.create',
        'uses' => 'NewsController@create',
        'middleware' => 'can:tradevillage.news.create'
    ]);
    $router->post('news', [
        'as' => 'admin.tradevillage.news.store',
        'uses' => 'NewsController@store',
        'middleware' => 'can:tradevillage.news.create'
    ]);
    $router->get('news/{news}/edit', [
        'as' => 'admin.tradevillage.news.edit',
        'uses' => 'NewsController@edit',
        'middleware' => 'can:tradevillage.news.edit'
    ]);
    $router->put('news/{news}', [
        'as' => 'admin.tradevillage.news.update',
        'uses' => 'NewsController@update',
        'middleware' => 'can:tradevillage.news.edit'
    ]);
    $router->delete('news/{news}', [
        'as' => 'admin.tradevillage.news.destroy',
        'uses' => 'NewsController@destroy',
        'middleware' => 'can:tradevillage.news.destroy'
    ]);
    $router->bind('links', function ($id) {
        return app('Modules\TradeVillage\Repositories\LinksRepository')->find($id);
    });
    $router->get('links', [
        'as' => 'admin.tradevillage.links.index',
        'uses' => 'LinksController@index',
        'middleware' => 'can:tradevillage.links.index'
    ]);
    $router->get('links/create', [
        'as' => 'admin.tradevillage.links.create',
        'uses' => 'LinksController@create',
        'middleware' => 'can:tradevillage.links.create'
    ]);
    $router->post('links', [
        'as' => 'admin.tradevillage.links.store',
        'uses' => 'LinksController@store',
        'middleware' => 'can:tradevillage.links.create'
    ]);
    $router->get('links/{links}/edit', [
        'as' => 'admin.tradevillage.links.edit',
        'uses' => 'LinksController@edit',
        'middleware' => 'can:tradevillage.links.edit'
    ]);
    $router->put('links/{links}', [
        'as' => 'admin.tradevillage.links.update',
        'uses' => 'LinksController@update',
        'middleware' => 'can:tradevillage.links.edit'
    ]);
    $router->delete('links/{links}', [
        'as' => 'admin.tradevillage.links.destroy',
        'uses' => 'LinksController@destroy',
        'middleware' => 'can:tradevillage.links.destroy'
    ]);
    $router->bind('products', function ($id) {
        return app('Modules\TradeVillage\Repositories\ProductsRepository')->find($id);
    });
    $router->get('products', [
        'as' => 'admin.tradevillage.products.index',
        'uses' => 'ProductsController@index',
        'middleware' => 'can:tradevillage.products.index'
    ]);
    $router->get('products/create', [
        'as' => 'admin.tradevillage.products.create',
        'uses' => 'ProductsController@create',
        'middleware' => 'can:tradevillage.products.create'
    ]);
    $router->post('products', [
        'as' => 'admin.tradevillage.products.store',
        'uses' => 'ProductsController@store',
        'middleware' => 'can:tradevillage.products.create'
    ]);
    $router->get('products/{products}/edit', [
        'as' => 'admin.tradevillage.products.edit',
        'uses' => 'ProductsController@edit',
        'middleware' => 'can:tradevillage.products.edit'
    ]);
    $router->put('products/{products}', [
        'as' => 'admin.tradevillage.products.update',
        'uses' => 'ProductsController@update',
        'middleware' => 'can:tradevillage.products.edit'
    ]);
    $router->delete('products/{products}', [
        'as' => 'admin.tradevillage.products.destroy',
        'uses' => 'ProductsController@destroy',
        'middleware' => 'can:tradevillage.products.destroy'
    ]);
    $router->bind('village_fields', function ($id) {
        return app('Modules\TradeVillage\Repositories\Village_fieldsRepository')->find($id);
    });
    $router->get('village_fields', [
        'as' => 'admin.tradevillage.village_fields.index',
        'uses' => 'Village_fieldsController@index',
        'middleware' => 'can:tradevillage.village_fields.index'
    ]);
    $router->get('village_fields/create', [
        'as' => 'admin.tradevillage.village_fields.create',
        'uses' => 'Village_fieldsController@create',
        'middleware' => 'can:tradevillage.village_fields.create'
    ]);
    $router->post('village_fields', [
        'as' => 'admin.tradevillage.village_fields.store',
        'uses' => 'Village_fieldsController@store',
        'middleware' => 'can:tradevillage.village_fields.create'
    ]);
    $router->get('village_fields/{village_fields}/edit', [
        'as' => 'admin.tradevillage.village_fields.edit',
        'uses' => 'Village_fieldsController@edit',
        'middleware' => 'can:tradevillage.village_fields.edit'
    ]);
    $router->put('village_fields/{village_fields}', [
        'as' => 'admin.tradevillage.village_fields.update',
        'uses' => 'Village_fieldsController@update',
        'middleware' => 'can:tradevillage.village_fields.edit'
    ]);
    $router->delete('village_fields/{village_fields}', [
        'as' => 'admin.tradevillage.village_fields.destroy',
        'uses' => 'Village_fieldsController@destroy',
        'middleware' => 'can:tradevillage.village_fields.destroy'
    ]);
    $router->bind('course_comments', function ($id) {
        return app('Modules\TradeVillage\Repositories\Course_commentsRepository')->find($id);
    });
    $router->get('course_comments', [
        'as' => 'admin.tradevillage.course_comments.index',
        'uses' => 'Course_commentsController@index',
        'middleware' => 'can:tradevillage.course_comments.index'
    ]);
    $router->get('course_comments/create', [
        'as' => 'admin.tradevillage.course_comments.create',
        'uses' => 'Course_commentsController@create',
        'middleware' => 'can:tradevillage.course_comments.create'
    ]);
    $router->post('course_comments', [
        'as' => 'admin.tradevillage.course_comments.store',
        'uses' => 'Course_commentsController@store',
        'middleware' => 'can:tradevillage.course_comments.create'
    ]);
    $router->get('course_comments/{course_comments}/edit', [
        'as' => 'admin.tradevillage.course_comments.edit',
        'uses' => 'Course_commentsController@edit',
        'middleware' => 'can:tradevillage.course_comments.edit'
    ]);
    $router->put('course_comments/{course_comments}', [
        'as' => 'admin.tradevillage.course_comments.update',
        'uses' => 'Course_commentsController@update',
        'middleware' => 'can:tradevillage.course_comments.edit'
    ]);
    $router->delete('course_comments/{course_comments}', [
        'as' => 'admin.tradevillage.course_comments.destroy',
        'uses' => 'Course_commentsController@destroy',
        'middleware' => 'can:tradevillage.course_comments.destroy'
    ]);
    $router->bind('product_comments', function ($id) {
        return app('Modules\TradeVillage\Repositories\Product_commentsRepository')->find($id);
    });
    $router->get('product_comments', [
        'as' => 'admin.tradevillage.product_comments.index',
        'uses' => 'Product_commentsController@index',
        'middleware' => 'can:tradevillage.product_comments.index'
    ]);
    $router->get('product_comments/create', [
        'as' => 'admin.tradevillage.product_comments.create',
        'uses' => 'Product_commentsController@create',
        'middleware' => 'can:tradevillage.product_comments.create'
    ]);
    $router->post('product_comments', [
        'as' => 'admin.tradevillage.product_comments.store',
        'uses' => 'Product_commentsController@store',
        'middleware' => 'can:tradevillage.product_comments.create'
    ]);
    $router->get('product_comments/{product_comments}/edit', [
        'as' => 'admin.tradevillage.product_comments.edit',
        'uses' => 'Product_commentsController@edit',
        'middleware' => 'can:tradevillage.product_comments.edit'
    ]);
    $router->put('product_comments/{product_comments}', [
        'as' => 'admin.tradevillage.product_comments.update',
        'uses' => 'Product_commentsController@update',
        'middleware' => 'can:tradevillage.product_comments.edit'
    ]);
    $router->delete('product_comments/{product_comments}', [
        'as' => 'admin.tradevillage.product_comments.destroy',
        'uses' => 'Product_commentsController@destroy',
        'middleware' => 'can:tradevillage.product_comments.destroy'
    ]);
    $router->bind('courses', function ($id) {
        return app('Modules\TradeVillage\Repositories\CoursesRepository')->find($id);
    });
    $router->get('courses', [
        'as' => 'admin.tradevillage.courses.index',
        'uses' => 'CoursesController@index',
        'middleware' => 'can:tradevillage.courses.index'
    ]);
    $router->get('courses/create', [
        'as' => 'admin.tradevillage.courses.create',
        'uses' => 'CoursesController@create',
        'middleware' => 'can:tradevillage.courses.create'
    ]);
    $router->post('courses', [
        'as' => 'admin.tradevillage.courses.store',
        'uses' => 'CoursesController@store',
        'middleware' => 'can:tradevillage.courses.create'
    ]);
    $router->get('courses/{courses}/edit', [
        'as' => 'admin.tradevillage.courses.edit',
        'uses' => 'CoursesController@edit',
        'middleware' => 'can:tradevillage.courses.edit'
    ]);
    $router->put('courses/{courses}', [
        'as' => 'admin.tradevillage.courses.update',
        'uses' => 'CoursesController@update',
        'middleware' => 'can:tradevillage.courses.edit'
    ]);
    $router->delete('courses/{courses}', [
        'as' => 'admin.tradevillage.courses.destroy',
        'uses' => 'CoursesController@destroy',
        'middleware' => 'can:tradevillage.courses.destroy'
    ]);
    $router->bind('edu_fields', function ($id) {
        return app('Modules\TradeVillage\Repositories\Edu_fieldsRepository')->find($id);
    });
    $router->get('edu_fields', [
        'as' => 'admin.tradevillage.edu_fields.index',
        'uses' => 'Edu_fieldsController@index',
        'middleware' => 'can:tradevillage.edu_fields.index'
    ]);
    $router->get('edu_fields/create', [
        'as' => 'admin.tradevillage.edu_fields.create',
        'uses' => 'Edu_fieldsController@create',
        'middleware' => 'can:tradevillage.edu_fields.create'
    ]);
    $router->post('edu_fields', [
        'as' => 'admin.tradevillage.edu_fields.store',
        'uses' => 'Edu_fieldsController@store',
        'middleware' => 'can:tradevillage.edu_fields.create'
    ]);
    $router->get('edu_fields/{edu_fields}/edit', [
        'as' => 'admin.tradevillage.edu_fields.edit',
        'uses' => 'Edu_fieldsController@edit',
        'middleware' => 'can:tradevillage.edu_fields.edit'
    ]);
    $router->put('edu_fields/{edu_fields}', [
        'as' => 'admin.tradevillage.edu_fields.update',
        'uses' => 'Edu_fieldsController@update',
        'middleware' => 'can:tradevillage.edu_fields.edit'
    ]);
    $router->delete('edu_fields/{edu_fields}', [
        'as' => 'admin.tradevillage.edu_fields.destroy',
        'uses' => 'Edu_fieldsController@destroy',
        'middleware' => 'can:tradevillage.edu_fields.destroy'
    ]);
    $router->bind('documents', function ($id) {
        return app('Modules\TradeVillage\Repositories\DocumentsRepository')->find($id);
    });
    $router->get('documents', [
        'as' => 'admin.tradevillage.documents.index',
        'uses' => 'DocumentsController@index',
        'middleware' => 'can:tradevillage.documents.index'
    ]);
    $router->get('documents/create', [
        'as' => 'admin.tradevillage.documents.create',
        'uses' => 'DocumentsController@create',
        'middleware' => 'can:tradevillage.documents.create'
    ]);
    $router->post('documents', [
        'as' => 'admin.tradevillage.documents.store',
        'uses' => 'DocumentsController@store',
        'middleware' => 'can:tradevillage.documents.create'
    ]);
    $router->get('documents/{documents}/edit', [
        'as' => 'admin.tradevillage.documents.edit',
        'uses' => 'DocumentsController@edit',
        'middleware' => 'can:tradevillage.documents.edit'
    ]);
    $router->put('documents/{documents}', [
        'as' => 'admin.tradevillage.documents.update',
        'uses' => 'DocumentsController@update',
        'middleware' => 'can:tradevillage.documents.edit'
    ]);
    $router->delete('documents/{documents}', [
        'as' => 'admin.tradevillage.documents.destroy',
        'uses' => 'DocumentsController@destroy',
        'middleware' => 'can:tradevillage.documents.destroy'
    ]);
    $router->bind('course_rates', function ($id) {
        return app('Modules\TradeVillage\Repositories\Course_ratesRepository')->find($id);
    });
    $router->get('course_rates', [
        'as' => 'admin.tradevillage.course_rates.index',
        'uses' => 'Course_ratesController@index',
        'middleware' => 'can:tradevillage.course_rates.index'
    ]);
    $router->get('course_rates/create', [
        'as' => 'admin.tradevillage.course_rates.create',
        'uses' => 'Course_ratesController@create',
        'middleware' => 'can:tradevillage.course_rates.create'
    ]);
    $router->post('course_rates', [
        'as' => 'admin.tradevillage.course_rates.store',
        'uses' => 'Course_ratesController@store',
        'middleware' => 'can:tradevillage.course_rates.create'
    ]);
    $router->get('course_rates/{course_rates}/edit', [
        'as' => 'admin.tradevillage.course_rates.edit',
        'uses' => 'Course_ratesController@edit',
        'middleware' => 'can:tradevillage.course_rates.edit'
    ]);
    $router->put('course_rates/{course_rates}', [
        'as' => 'admin.tradevillage.course_rates.update',
        'uses' => 'Course_ratesController@update',
        'middleware' => 'can:tradevillage.course_rates.edit'
    ]);
    $router->delete('course_rates/{course_rates}', [
        'as' => 'admin.tradevillage.course_rates.destroy',
        'uses' => 'Course_ratesController@destroy',
        'middleware' => 'can:tradevillage.course_rates.destroy'
    ]);
    $router->bind('course_users', function ($id) {
        return app('Modules\TradeVillage\Repositories\Course_usersRepository')->find($id);
    });
    $router->get('course_users', [
        'as' => 'admin.tradevillage.course_users.index',
        'uses' => 'Course_usersController@index',
        'middleware' => 'can:tradevillage.course_users.index'
    ]);
    $router->get('course_users/create', [
        'as' => 'admin.tradevillage.course_users.create',
        'uses' => 'Course_usersController@create',
        'middleware' => 'can:tradevillage.course_users.create'
    ]);
    $router->post('course_users', [
        'as' => 'admin.tradevillage.course_users.store',
        'uses' => 'Course_usersController@store',
        'middleware' => 'can:tradevillage.course_users.create'
    ]);
    $router->get('course_users/{course_users}/edit', [
        'as' => 'admin.tradevillage.course_users.edit',
        'uses' => 'Course_usersController@edit',
        'middleware' => 'can:tradevillage.course_users.edit'
    ]);
    $router->put('course_users/{course_users}', [
        'as' => 'admin.tradevillage.course_users.update',
        'uses' => 'Course_usersController@update',
        'middleware' => 'can:tradevillage.course_users.edit'
    ]);
    $router->delete('course_users/{course_users}', [
        'as' => 'admin.tradevillage.course_users.destroy',
        'uses' => 'Course_usersController@destroy',
        'middleware' => 'can:tradevillage.course_users.destroy'
    ]);
    $router->bind('edu_course_fields', function ($id) {
        return app('Modules\TradeVillage\Repositories\Edu_course_fieldsRepository')->find($id);
    });
    $router->get('edu_course_fields', [
        'as' => 'admin.tradevillage.edu_course_fields.index',
        'uses' => 'Edu_course_fieldsController@index',
        'middleware' => 'can:tradevillage.edu_course_fields.index'
    ]);
    $router->get('edu_course_fields/create', [
        'as' => 'admin.tradevillage.edu_course_fields.create',
        'uses' => 'Edu_course_fieldsController@create',
        'middleware' => 'can:tradevillage.edu_course_fields.create'
    ]);
    $router->post('edu_course_fields', [
        'as' => 'admin.tradevillage.edu_course_fields.store',
        'uses' => 'Edu_course_fieldsController@store',
        'middleware' => 'can:tradevillage.edu_course_fields.create'
    ]);
    $router->get('edu_course_fields/{edu_course_fields}/edit', [
        'as' => 'admin.tradevillage.edu_course_fields.edit',
        'uses' => 'Edu_course_fieldsController@edit',
        'middleware' => 'can:tradevillage.edu_course_fields.edit'
    ]);
    $router->put('edu_course_fields/{edu_course_fields}', [
        'as' => 'admin.tradevillage.edu_course_fields.update',
        'uses' => 'Edu_course_fieldsController@update',
        'middleware' => 'can:tradevillage.edu_course_fields.edit'
    ]);
    $router->delete('edu_course_fields/{edu_course_fields}', [
        'as' => 'admin.tradevillage.edu_course_fields.destroy',
        'uses' => 'Edu_course_fieldsController@destroy',
        'middleware' => 'can:tradevillage.edu_course_fields.destroy'
    ]);
    $router->bind('video', function ($id) {
        return app('Modules\TradeVillage\Repositories\VideoRepository')->find($id);
    });
    $router->get('videos', [
        'as' => 'admin.tradevillage.video.index',
        'uses' => 'VideoController@index',
        'middleware' => 'can:tradevillage.videos.index'
    ]);
    $router->get('videos/create', [
        'as' => 'admin.tradevillage.video.create',
        'uses' => 'VideoController@create',
        'middleware' => 'can:tradevillage.videos.create'
    ]);
    $router->post('videos', [
        'as' => 'admin.tradevillage.video.store',
        'uses' => 'VideoController@store',
        'middleware' => 'can:tradevillage.videos.create'
    ]);
    $router->get('videos/{video}/edit', [
        'as' => 'admin.tradevillage.video.edit',
        'uses' => 'VideoController@edit',
        'middleware' => 'can:tradevillage.videos.edit'
    ]);
    $router->put('videos/{video}', [
        'as' => 'admin.tradevillage.video.update',
        'uses' => 'VideoController@update',
        'middleware' => 'can:tradevillage.videos.edit'
    ]);
    $router->delete('videos/{video}', [
        'as' => 'admin.tradevillage.video.destroy',
        'uses' => 'VideoController@destroy',
        'middleware' => 'can:tradevillage.videos.destroy'
    ]);
    $router->bind('village_coordinates', function ($id) {
        return app('Modules\TradeVillage\Repositories\Village_coordinatesRepository')->find($id);
    });
    $router->get('village_coordinates', [
        'as' => 'admin.tradevillage.village_coordinates.index',
        'uses' => 'Village_coordinatesController@index',
        'middleware' => 'can:tradevillage.village_coordinates.index'
    ]);
    $router->get('village_coordinates/create', [
        'as' => 'admin.tradevillage.village_coordinates.create',
        'uses' => 'Village_coordinatesController@create',
        'middleware' => 'can:tradevillage.village_coordinates.create'
    ]);
    $router->post('village_coordinates', [
        'as' => 'admin.tradevillage.village_coordinates.store',
        'uses' => 'Village_coordinatesController@store',
        'middleware' => 'can:tradevillage.village_coordinates.create'
    ]);
    $router->get('village_coordinates/{village_coordinates}/edit', [
        'as' => 'admin.tradevillage.village_coordinates.edit',
        'uses' => 'Village_coordinatesController@edit',
        'middleware' => 'can:tradevillage.village_coordinates.edit'
    ]);
    $router->put('village_coordinates/{village_coordinates}', [
        'as' => 'admin.tradevillage.village_coordinates.update',
        'uses' => 'Village_coordinatesController@update',
        'middleware' => 'can:tradevillage.village_coordinates.edit'
    ]);
    $router->delete('village_coordinates/{village_coordinates}', [
        'as' => 'admin.tradevillage.village_coordinates.destroy',
        'uses' => 'Village_coordinatesController@destroy',
        'middleware' => 'can:tradevillage.village_coordinates.destroy'
    ]);
    $router->bind('events', function ($id) {
        return app('Modules\TradeVillage\Repositories\EventsRepository')->find($id);
    });
    $router->get('events', [
        'as' => 'admin.tradevillage.events.index',
        'uses' => 'EventsController@index',
        'middleware' => 'can:tradevillage.events.index'
    ]);
    $router->get('events/create', [
        'as' => 'admin.tradevillage.events.create',
        'uses' => 'EventsController@create',
        'middleware' => 'can:tradevillage.events.create'
    ]);
    $router->post('events', [
        'as' => 'admin.tradevillage.events.store',
        'uses' => 'EventsController@store',
        'middleware' => 'can:tradevillage.events.create'
    ]);
    $router->get('events/{events}/edit', [
        'as' => 'admin.tradevillage.events.edit',
        'uses' => 'EventsController@edit',
        'middleware' => 'can:tradevillage.events.edit'
    ]);
    $router->put('events/{events}', [
        'as' => 'admin.tradevillage.events.update',
        'uses' => 'EventsController@update',
        'middleware' => 'can:tradevillage.events.edit'
    ]);
    $router->delete('events/{events}', [
        'as' => 'admin.tradevillage.events.destroy',
        'uses' => 'EventsController@destroy',
        'middleware' => 'can:tradevillage.events.destroy'
    ]);
    $router->bind('artist', function ($id) {
        return app('Modules\TradeVillage\Repositories\ArtistRepository')->find($id);
    });
    $router->get('artists', [
        'as' => 'admin.tradevillage.artist.index',
        'uses' => 'ArtistController@index',
        'middleware' => 'can:tradevillage.artists.index'
    ]);
    $router->get('artists/create', [
        'as' => 'admin.tradevillage.artist.create',
        'uses' => 'ArtistController@create',
        'middleware' => 'can:tradevillage.artists.create'
    ]);
    $router->post('artists', [
        'as' => 'admin.tradevillage.artist.store',
        'uses' => 'ArtistController@store',
        'middleware' => 'can:tradevillage.artists.create'
    ]);
    $router->get('artists/{artist}/edit', [
        'as' => 'admin.tradevillage.artist.edit',
        'uses' => 'ArtistController@edit',
        'middleware' => 'can:tradevillage.artists.edit'
    ]);
    $router->put('artists/{artist}', [
        'as' => 'admin.tradevillage.artist.update',
        'uses' => 'ArtistController@update',
        'middleware' => 'can:tradevillage.artists.edit'
    ]);
    $router->delete('artists/{artist}', [
        'as' => 'admin.tradevillage.artist.destroy',
        'uses' => 'ArtistController@destroy',
        'middleware' => 'can:tradevillage.artists.destroy'
    ]);
    $router->bind('process', function ($id) {
        return app('Modules\TradeVillage\Repositories\ProcessRepository')->find($id);
    });
    $router->get('processes', [
        'as' => 'admin.tradevillage.process.index',
        'uses' => 'ProcessController@index',
        'middleware' => 'can:tradevillage.processes.index'
    ]);
    $router->get('processes/create', [
        'as' => 'admin.tradevillage.process.create',
        'uses' => 'ProcessController@create',
        'middleware' => 'can:tradevillage.processes.create'
    ]);
    $router->post('processes', [
        'as' => 'admin.tradevillage.process.store',
        'uses' => 'ProcessController@store',
        'middleware' => 'can:tradevillage.processes.create'
    ]);
    $router->get('processes/{process}/edit', [
        'as' => 'admin.tradevillage.process.edit',
        'uses' => 'ProcessController@edit',
        'middleware' => 'can:tradevillage.processes.edit'
    ]);
    $router->put('processes/{process}', [
        'as' => 'admin.tradevillage.process.update',
        'uses' => 'ProcessController@update',
        'middleware' => 'can:tradevillage.processes.edit'
    ]);
    $router->delete('processes/{process}', [
        'as' => 'admin.tradevillage.process.destroy',
        'uses' => 'ProcessController@destroy',
        'middleware' => 'can:tradevillage.processes.destroy'
    ]);
    $router->bind('product_rate', function ($id) {
        return app('Modules\TradeVillage\Repositories\Product_rateRepository')->find($id);
    });
    $router->get('product_rates', [
        'as' => 'admin.tradevillage.product_rate.index',
        'uses' => 'Product_rateController@index',
        'middleware' => 'can:tradevillage.product_rates.index'
    ]);
    $router->get('product_rates/create', [
        'as' => 'admin.tradevillage.product_rate.create',
        'uses' => 'Product_rateController@create',
        'middleware' => 'can:tradevillage.product_rates.create'
    ]);
    $router->post('product_rates', [
        'as' => 'admin.tradevillage.product_rate.store',
        'uses' => 'Product_rateController@store',
        'middleware' => 'can:tradevillage.product_rates.create'
    ]);
    $router->get('product_rates/{product_rate}/edit', [
        'as' => 'admin.tradevillage.product_rate.edit',
        'uses' => 'Product_rateController@edit',
        'middleware' => 'can:tradevillage.product_rates.edit'
    ]);
    $router->put('product_rates/{product_rate}', [
        'as' => 'admin.tradevillage.product_rate.update',
        'uses' => 'Product_rateController@update',
        'middleware' => 'can:tradevillage.product_rates.edit'
    ]);
    $router->delete('product_rates/{product_rate}', [
        'as' => 'admin.tradevillage.product_rate.destroy',
        'uses' => 'Product_rateController@destroy',
        'middleware' => 'can:tradevillage.product_rates.destroy'
    ]);
// append




















});
