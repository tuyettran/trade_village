<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\Edu_course_fieldsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheEdu_course_fieldsDecorator extends BaseCacheDecorator implements Edu_course_fieldsRepository
{
    public function __construct(Edu_course_fieldsRepository $edu_course_fields)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.edu_course_fields';
        $this->repository = $edu_course_fields;
    }
}
