<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\Village_fieldsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheVillage_fieldsDecorator extends BaseCacheDecorator implements Village_fieldsRepository
{
    public function __construct(Village_fieldsRepository $village_fields)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.village_fields';
        $this->repository = $village_fields;
    }
}
