<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\Product_commentsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheProduct_commentsDecorator extends BaseCacheDecorator implements Product_commentsRepository
{
    public function __construct(Product_commentsRepository $product_comments)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.product_comments';
        $this->repository = $product_comments;
    }
}
