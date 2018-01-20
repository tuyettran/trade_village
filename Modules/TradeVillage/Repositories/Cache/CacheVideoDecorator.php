<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\VideoRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheVideoDecorator extends BaseCacheDecorator implements VideoRepository
{
    public function __construct(VideoRepository $video)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.videos';
        $this->repository = $video;
    }
}
