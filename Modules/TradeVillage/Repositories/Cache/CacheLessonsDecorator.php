<?php

namespace Modules\Tradevillage\Repositories\Cache;

use Modules\Tradevillage\Repositories\LessonsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheLessonsDecorator extends BaseCacheDecorator implements LessonsRepository
{
    public function __construct(LessonsRepository $lessons)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.lessons';
        $this->repository = $lessons;
    }
}
