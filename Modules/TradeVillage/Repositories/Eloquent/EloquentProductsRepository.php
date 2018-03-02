<?php

namespace Modules\TradeVillage\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentProductsRepository extends EloquentBaseRepository implements ProductsRepository
{
	// public function findByCategory($category){
	// 	$products = DB::table('tradevillage__products')->join('tradevillage__enterprises', 'tradevillage__products.enterprise_id', '=', 'tradevillage__enterprises.id')->join('tradevillage__villages', 'tradevillage__villages.id', '=', 'tradevillage__enterprises.village_id')->where('tradevillage__villages.category_id', '=', $category)->select('tradevillage__products.*')->limit(4)->get();
	// 	return $products;
}
