<?php

namespace Modules\TradeVillage\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface NewsRepository extends BaseRepository
{
	public function latestNews($villageId, $number);
}
