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
}
