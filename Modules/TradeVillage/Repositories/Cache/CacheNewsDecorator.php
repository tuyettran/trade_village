<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\NewsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheNewsDecorator extends BaseCacheDecorator implements NewsRepository
{
    public function __construct(NewsRepository $news)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.news';
        $this->repository = $news;
    }
}
