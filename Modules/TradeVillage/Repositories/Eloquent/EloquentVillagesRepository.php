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
}
