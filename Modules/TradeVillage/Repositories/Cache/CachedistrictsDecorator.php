<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\districtsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachedistrictsDecorator extends BaseCacheDecorator implements districtsRepository
{
    public function __construct(districtsRepository $districts)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.districts';
        $this->repository = $districts;
    }
}
