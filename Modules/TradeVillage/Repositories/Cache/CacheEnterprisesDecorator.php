<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\EnterprisesRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheEnterprisesDecorator extends BaseCacheDecorator implements EnterprisesRepository
{
    public function __construct(EnterprisesRepository $enterprises)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.enterprises';
        $this->repository = $enterprises;
    }
}
