<?php

namespace Modules\TradeVillage\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\TradeVillage\Events\Handlers\RegisterTradeVillageSidebar;

class TradeVillageServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterTradeVillageSidebar::class);
    }

    public function boot()
    {
        $this->publishConfig('tradevillage', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\TradeVillage\Repositories\VillagesRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentVillagesRepository(new \Modules\TradeVillage\Entities\Villages());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheVillagesDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\EnterprisesRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentEnterprisesRepository(new \Modules\TradeVillage\Entities\Enterprises());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheEnterprisesDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\NewsRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentNewsRepository(new \Modules\TradeVillage\Entities\News());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheNewsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\LinksRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentLinksRepository(new \Modules\TradeVillage\Entities\Links());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheLinksDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\ProductsRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentProductsRepository(new \Modules\TradeVillage\Entities\Products());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheProductsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\Village_fieldsRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentVillage_fieldsRepository(new \Modules\TradeVillage\Entities\Village_fields());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheVillage_fieldsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\Course_commentsRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentCourse_commentsRepository(new \Modules\TradeVillage\Entities\Course_comments());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheCourse_commentsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\Product_commentsRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentProduct_commentsRepository(new \Modules\TradeVillage\Entities\Product_comments());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheProduct_commentsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\CoursesRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentCoursesRepository(new \Modules\TradeVillage\Entities\Courses());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheCoursesDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\Edu_fieldsRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentEdu_fieldsRepository(new \Modules\TradeVillage\Entities\Edu_fields());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheEdu_fieldsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\DocumentsRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentDocumentsRepository(new \Modules\TradeVillage\Entities\Documents());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheDocumentsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\Course_ratesRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentCourse_ratesRepository(new \Modules\TradeVillage\Entities\Course_rates());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheCourse_ratesDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\Course_usersRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentCourse_usersRepository(new \Modules\TradeVillage\Entities\Course_users());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheCourse_usersDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\Edu_course_fieldsRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentEdu_course_fieldsRepository(new \Modules\TradeVillage\Entities\Edu_course_fields());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheEdu_course_fieldsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\VideoRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentVideoRepository(new \Modules\TradeVillage\Entities\Video());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheVideoDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\Village_coordinatesRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentVillage_coordinatesRepository(new \Modules\TradeVillage\Entities\Village_coordinates());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheVillage_coordinatesDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\EventsRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentEventsRepository(new \Modules\TradeVillage\Entities\Events());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheEventsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\ArtistRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentArtistRepository(new \Modules\TradeVillage\Entities\Artist());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheArtistDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\ProcessRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentProcessRepository(new \Modules\TradeVillage\Entities\Process());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheProcessDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\TradeVillage\Repositories\Product_rateRepository',
            function () {
                $repository = new \Modules\TradeVillage\Repositories\Eloquent\EloquentProduct_rateRepository(new \Modules\TradeVillage\Entities\Product_rate());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\TradeVillage\Repositories\Cache\CacheProduct_rateDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Tradevillage\Repositories\provincesRepository',
            function () {
                $repository = new \Modules\Tradevillage\Repositories\Eloquent\EloquentprovincesRepository(new \Modules\Tradevillage\Entities\provinces());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Tradevillage\Repositories\Cache\CacheprovincesDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Tradevillage\Repositories\districtsRepository',
            function () {
                $repository = new \Modules\Tradevillage\Repositories\Eloquent\EloquentdistrictsRepository(new \Modules\Tradevillage\Entities\districts());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Tradevillage\Repositories\Cache\CachedistrictsDecorator($repository);
            }
        );
// add bindings






















    }
}
