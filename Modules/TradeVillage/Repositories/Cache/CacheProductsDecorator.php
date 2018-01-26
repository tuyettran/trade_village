<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheProductsDecorator extends BaseCacheDecorator implements ProductsRepository
{
    public function __construct(ProductsRepository $products)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.products';
        $this->repository = $products;
    }
}
