<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\VillagesRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheVillagesDecorator extends BaseCacheDecorator implements VillagesRepository
{
    public function __construct(VillagesRepository $villages)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.villages';
        $this->repository = $villages;
    }
}
