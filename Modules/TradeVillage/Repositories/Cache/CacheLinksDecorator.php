<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\LinksRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheLinksDecorator extends BaseCacheDecorator implements LinksRepository
{
    public function __construct(LinksRepository $links)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.links';
        $this->repository = $links;
    }
}
