<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\CoursesRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCoursesDecorator extends BaseCacheDecorator implements CoursesRepository
{
    public function __construct(CoursesRepository $courses)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.courses';
        $this->repository = $courses;
    }
}
