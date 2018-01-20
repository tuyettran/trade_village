<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\Edu_fieldsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheEdu_fieldsDecorator extends BaseCacheDecorator implements Edu_fieldsRepository
{
    public function __construct(Edu_fieldsRepository $edu_fields)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.edu_fields';
        $this->repository = $edu_fields;
    }
}
