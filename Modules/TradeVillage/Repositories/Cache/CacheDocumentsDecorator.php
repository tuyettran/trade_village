<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\DocumentsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheDocumentsDecorator extends BaseCacheDecorator implements DocumentsRepository
{
    public function __construct(DocumentsRepository $documents)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.documents';
        $this->repository = $documents;
    }
}
