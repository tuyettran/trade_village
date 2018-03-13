<?php

namespace Modules\TradeVillage\Repositories\Eloquent;

use Modules\TradeVillage\Repositories\EventsRepository;
use Modules\TradeVillage\Events\EventWasUpdated;
use Modules\TradeVillage\Events\EventWasDeleted;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

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
}
