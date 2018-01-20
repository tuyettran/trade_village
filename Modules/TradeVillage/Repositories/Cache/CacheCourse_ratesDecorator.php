<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\Course_ratesRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCourse_ratesDecorator extends BaseCacheDecorator implements Course_ratesRepository
{
    public function __construct(Course_ratesRepository $course_rates)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.course_rates';
        $this->repository = $course_rates;
    }
}
