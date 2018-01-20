<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\Product_rateRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheProduct_rateDecorator extends BaseCacheDecorator implements Product_rateRepository
{
    public function __construct(Product_rateRepository $product_rate)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.product_rates';
        $this->repository = $product_rate;
    }
}
