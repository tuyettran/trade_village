<?php

namespace Modules\TradeVillage\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface VillagesRepository extends BaseRepository
{
	public function search($key, $category, $provice, $locale);
	public function simple_search($key, $locale);
	public function getByCategory($category_id);
}
