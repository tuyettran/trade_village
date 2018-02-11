<?php

namespace Modules\Tradevillage\Repositories\Cache;

use Modules\Tradevillage\Repositories\provincesRepository;
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
