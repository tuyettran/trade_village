<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\EventsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheEventsDecorator extends BaseCacheDecorator implements EventsRepository
{
    public function __construct(EventsRepository $events)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.events';
        $this->repository = $events;
    }
}
