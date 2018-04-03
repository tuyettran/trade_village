<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\provincesRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheprovincesDecorator extends BaseCacheDecorator implements provincesRepository
{
    public function __construct(provincesRepository $provinces)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.provinces';
        $this->repository = $provinces;
    }
}
