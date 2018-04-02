<?php

namespace Modules\TradeVillage\Repositories\Eloquent;

use Modules\TradeVillage\Events\VillageWasCreated;
use Modules\TradeVillage\Events\VillageWasDeleted;
use Modules\TradeVillage\Events\VillageWasUpdated;
use Modules\TradeVillage\Repositories\VillagesRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentVillagesRepository extends EloquentBaseRepository implements VillagesRepository
{
    public function create($data){
        $village = $this->model->create($data);
        event(new VillageWasCreated($village, $data));
        return $village;
    }

    public function update($village, $data){
        $village->update($data);
        event(new VillageWasUpdated($village, $data));
        return $village;
    }

    public function destroy($village){
        event(new VillageWasDeleted($village));
        return $village->delete();
    }

    public function getByCategory($category_id){
        $query = $this->buildQueryByAttributes(['category_id' => $category_id ])->pluck('id')->toArray();;

        return $query;
    }

    public function search($key, $locale){
        $query = $this->model->query();
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')
            ->whereHas('translations', function ($query) use ($locale, $key) {
                $query->where('locale', $locale)->where('name', 'like', '%'.$key.'%')->orWhere('description', 'like', '%'.$key.'%');
            });
        }
        return $this->model->all();
    }

    private function buildQueryByAttributes(array $attributes, $orderBy = null, $sortOrder = 'asc')
    {
        $query = $this->model->query();

        if (method_exists($this->model, 'translations')) {
            $query = $query->with('translations');
        }

        foreach ($attributes as $field => $value) {
            $query = $query->where($field, $value);
        }

        if (null !== $orderBy) {
            $query->orderBy($orderBy, $sortOrder);
        }

        return $query;
    }
}
