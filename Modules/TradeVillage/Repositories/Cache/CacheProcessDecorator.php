<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\ProcessRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheProcessDecorator extends BaseCacheDecorator implements ProcessRepository
{
    public function __construct(ProcessRepository $process)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.processes';
        $this->repository = $process;
    }
}
