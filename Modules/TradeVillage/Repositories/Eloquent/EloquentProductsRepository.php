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

    public function getAllByVillage($enterprises, $artists){
        $query = $this->model->query();
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->whereIn('artist_id', $artists)
                ->orWhere(function ($query) use ($enterprises){
                    $query->whereIn('enterprise_id', $enterprises);
                });
        }
        return $this->model->whereIn('artist_id', $artists)
            ->orWhere(function ($query) {
                $query->whereIn('enterprise_id', $enterprises);
            });
    }
    
    public function search($key, $locale, $category, $favorite){
        $query = $this->model->query();
        if($category != 0 && $favorite != null)
            return $this->model->with('translations')->where('category_id', '=', $category)
            ->whereHas('translations', function ($query) use ($locale, $key) {
                $query->where('locale', $locale)->where('name', 'like', '%'.$key.'%')->orWhere('description', 'like', '%'.$key.'%');
            })->orderBy('rate', $favorite);
        elseif($category == 0 && $favorite == null)
            return $this->model->with('translations')
            ->whereHas('translations', function ($query) use ($locale, $key) {
                $query->where('locale', $locale)->where('name', 'like', '%'.$key.'%')->orWhere('description', 'like', '%'.$key.'%');
            })->orderBy('created_at', 'desc');
        elseif($category == 0){
            return $this->model->with('translations')
            ->whereHas('translations', function ($query) use ($locale, $key) {
                $query->where('locale', $locale)->where('name', 'like', '%'.$key.'%')->orWhere('description', 'like', '%'.$key.'%');
            })->orderBy('rate', $favorite)->orderBy('created_at', 'desc');
        }
        elseif($favorite == null) {
            return $this->model->with('translations')->where('category_id', '=', $category)
            ->whereHas('translations', function ($query) use ($locale, $key) {
                $query->where('locale', $locale)->where('name', 'like', '%'.$key.'%')->orWhere('description', 'like', '%'.$key.'%');
            });
        }
    }

    public function simple_search($key, $locale){
        return $this->model->with('translations')
            ->whereHas('translations', function ($query) use ($locale, $key) {
                $query->where('locale', $locale)->where('name', 'like', '%'.$key.'%')->orWhere('description', 'like', '%'.$key.'%');
        });
    }
}
