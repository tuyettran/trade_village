<?php

namespace Modules\TradeVillage\Repositories\Eloquent;

use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\TradeVillage\Events\ProductWasUpdated;
use Modules\TradeVillage\Events\ProductWasDeleted;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentProductsRepository extends EloquentBaseRepository implements ProductsRepository
{
	public function create($data){
		$product = $this->model->create($data);
		event(new ProductWasUpdated($product, $data));
		return $product;
	}

	public function update($product, $data){
		$product->update($data);
		event(new ProductWasUpdated($product, $data));
		return $product;
	}

	public function destroy($product){
		event(new ProductWasDeleted($product));
		return $product->delete();
	}
}
