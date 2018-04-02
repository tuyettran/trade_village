<?php

namespace Modules\TradeVillage\Repositories\Eloquent;

use Modules\TradeVillage\Repositories\EventsRepository;
use Modules\TradeVillage\Events\EventWasUpdated;
use Modules\TradeVillage\Events\EventWasDeleted;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Carbon\Carbon;

class EloquentEventsRepository extends EloquentBaseRepository implements EventsRepository
{
	public function create($data){
		$events = $this->model->create($data);
		event(new EventWasUpdated($events, $data));
		return $events;
	}

	public function update($events, $data){
		$events->update($data);
		event(new EventWasUpdated($events, $data));
		return $events;
	}

	public function destroy($events){
		event(new EventWasDeleted($events));
		return $events->delete();
	}

	public function newest_events($number){
		if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->orderBy('created_at', 'DESC')->limit($number)->get();
        }

        return $this->model->orderBy('created_at', 'DESC')->limit($number)->get();
	}

	public function nearest_events($number){
		$now = Carbon::now();
		if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->where('start_time', '>', $now)->orWhere('end_time', '>', $now)->orderBy('end_time', 'DESC')->limit($number)->get();
        }

        return $this->model->where('start_time', '>', $now)->orWhere('end_time', '<', $now)->orderBy('end_time', 'DESC')->limit($number)->get();
	}

	public function getEventsByAttributes(array $attributes){
        $query = $this->buildQueryByAttributes($attributes);

        return $query;
    }

    public function search($key, $locale){
        $query = $this->model->query();
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')
            ->whereHas('translations', function ($query) use ($locale, $key) {
                $query->where('locale', $locale)->where('title', 'like', '%'.$key.'%');
            });
        }
        return $this->model->all();
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
