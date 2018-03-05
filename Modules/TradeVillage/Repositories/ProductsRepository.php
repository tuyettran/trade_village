<?php

namespace Modules\TradeVillage\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface ProductsRepository extends BaseRepository
{
	public function newest($number);
	public function favorite($number);
	public function hot($number);
}
