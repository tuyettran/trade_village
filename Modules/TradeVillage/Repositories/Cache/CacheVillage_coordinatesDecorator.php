<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\Village_coordinatesRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheVillage_coordinatesDecorator extends BaseCacheDecorator implements Village_coordinatesRepository
{
    public function __construct(Village_coordinatesRepository $village_coordinates)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.village_coordinates';
        $this->repository = $village_coordinates;
    }
}
