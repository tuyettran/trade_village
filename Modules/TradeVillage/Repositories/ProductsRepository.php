<?php

namespace Modules\TradeVillage\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface ProductsRepository extends BaseRepository
{
	public function newest($number);
	public function favorite($number);
	public function hot($number);
	public function getAllByVillage($enterprises, $artists);
	public function getAllByAttributes(array $attributes);
	public function search($key, $locale, $category, $favorite);
	public function simple_search($key, $locale);
}
