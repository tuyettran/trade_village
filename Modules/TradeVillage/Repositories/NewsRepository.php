<?php

namespace Modules\TradeVillage\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface NewsRepository extends BaseRepository
{
	public function latestNews($villageId, $number);
	public function newest($number);
	public function getNewsByAttributes(array $attributes);
	public function search($key, $locale);
}
