<?php

namespace Modules\TradeVillage\Repositories\Eloquent;

use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Illuminate\Auth\UserInterface;

class EloquentProductsRepository extends EloquentBaseRepository implements ProductsRepository
{
	public function findByCategory($category){
		
	}
}
