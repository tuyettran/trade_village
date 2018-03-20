<?php

namespace Modules\TradeVillage\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Repositories\ProductsRepository;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentProductsRepository extends EloquentBaseRepository implements ProductsRepository
{
	public function newest($number)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->orderBy('created_at', 'DESC')->limit($number)->get();
        }

        return $this->model->orderBy('created_at', 'DESC')->limit($number)->get();
    }

    public function favorite($number)
    {
    	if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->orderBy('rate', 'DESC')->limit($number)->get();
        }

        return $this->model->orderBy('rate', 'DESC')->limit($number)->get();
    }

    public function hot($number){
    	if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->orderBy('visitor_counter', 'DESC')->limit($number)->get();
        }
        return $this->model->orderBy('visitor_counter', 'DESC')->limit($number)->get();
    }
    
}
