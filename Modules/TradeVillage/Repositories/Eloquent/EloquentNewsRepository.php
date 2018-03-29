<?php

namespace Modules\TradeVillage\Repositories\Eloquent;

use Modules\TradeVillage\Events\NewsWasCreated;
use Modules\TradeVillage\Events\NewsWasDeleted;
use Modules\TradeVillage\Events\NewsWasUpdated;
use Modules\TradeVillage\Repositories\NewsRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentNewsRepository extends EloquentBaseRepository implements NewsRepository
{
	public function create($data){
        $new = $this->model->create($data);
        event(new NewsWasCreated($new, $data));
        return $new;
    }

    public function update($new, $data){
        $new->update($data);
        event(new NewsWasUpdated($new, $data));
        return $new;
    }

    public function destroy($new){
        event(new NewsWasDeleted($new));
        return $new->delete();
    }

    public function latestNews($villageId, $number) {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->join('tradevillage__villages', 'tradevillage__villages.id', '=', 'tradevillage__news.village_id') ->where('tradevillage__news.village_id', '=', $villageId)->select('tradevillage__news.*')->orderBy('updated_at', 'DESC')->limit($number)->get();
        }

        return $this->model->join('tradevillage__villages', 'tradevillage__villages.id', '=', 'tradevillage__news.village_id') ->where('tradevillage__news.village_id', '=', $villageId)->select('tradevillage__news.*')->orderBy('updated_at', 'DESC')->limit($number)->get();
    }

    public function newest($number) {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->select('tradevillage__news.*')->orderBy('updated_at', 'DESC')->limit($number)->get();
        }

        return $this->model->select('tradevillage__news.*')->orderBy('updated_at', 'DESC')->limit($number)->get();
    }

    public function getNewsByAttributes(array $attributes){
        $query = $this->buildQueryByAttributes($attributes);

        return $query;
    }

    public function search($key, $locale){
        $query = $this->model->query();
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')
            ->whereHas('translations', function ($query) use ($locale, $key) {
                $query->where('locale', $locale)->where('title', 'like binary', '%'.$key.'%');
            })->get();
        }
        return $this->model
            ->whereHas('translations', function ($query) use ($locale, $key) {
                $query->where('locale', $locale)->where('title', 'like binary', '%'.$key.'%');
            })->get();
    }

    private function buildQueryByAttributes(array $attributes)
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
}
