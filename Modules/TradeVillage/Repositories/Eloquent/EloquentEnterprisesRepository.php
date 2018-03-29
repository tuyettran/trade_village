<?php

namespace Modules\TradeVillage\Repositories\Eloquent;

use Modules\TradeVillage\Events\EnterpriseWasCreated;
use Modules\TradeVillage\Events\EnterpriseWasDeleted;
use Modules\TradeVillage\Events\EnterpriseWasUpdated;
use Modules\TradeVillage\Repositories\EnterprisesRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentEnterprisesRepository extends EloquentBaseRepository implements EnterprisesRepository
{
	public function create($data){
        $enterprise = $this->model->create($data);
        event(new EnterpriseWasCreated($enterprise, $data));
        return $enterprise;
    }

    public function update($enterprise, $data){
        $enterprise->update($data);
        event(new EnterpriseWasUpdated($enterprise, $data));
        return $enterprise;
    }

    public function destroy($enterprise){
        event(new EnterpriseWasDeleted($enterprise));
        return $enterprise->delete();
    }

    public function getEnterpriseByAttributes(array $attributes)
    {
        $query = $this->model->query();

        if (method_exists($this->model, 'translations')) {
            $query = $query->with('translations');
        }

        foreach ($attributes as $field => $value) {
            $query = $query->where($field, $value);
        }

        return $query;
    }

    public function search($key, $locale){
        $query = $this->model->query();
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')
            ->whereHas('translations', function ($query) use ($locale, $key) {
                $query->where('locale', $locale)->where('name', 'like binary', '%'.$key.'%')->orWhere('description', 'like binary', '%'.$key.'%');
            })->get();
        }
        return $this->model
            ->whereHas('translations', function ($query) use ($locale, $key) {
                $query->where('locale', $locale)->where('name', 'like', '%'.$key.'%')->orWhere('description', 'like', '%'.$key.'%');
            })->get();
    }
}
