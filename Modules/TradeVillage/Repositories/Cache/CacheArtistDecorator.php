<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\ArtistRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheArtistDecorator extends BaseCacheDecorator implements ArtistRepository
{
    public function __construct(ArtistRepository $artist)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.artists';
        $this->repository = $artist;
    }
}
