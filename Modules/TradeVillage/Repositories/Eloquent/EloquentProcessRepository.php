<?php

namespace Modules\TradeVillage\Repositories\Eloquent;
use Modules\TradeVillage\Events\ProcessWasCreated;
use Modules\TradeVillage\Events\ProcessWasUpdated;
use Modules\TradeVillage\Events\ProcessWasDeleted;
use Modules\TradeVillage\Repositories\ProcessRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentProcessRepository extends EloquentBaseRepository implements ProcessRepository
{
	public function create($data){
		$process = $this->model->create($data);
		event(new ProcessWasCreated($process, $data));
		return $process;
	}

	public function update($process, $data){
		$process->update($data);
		event(new ProcessWasUpdated($process, $data));
		return $process;
	}

	public function destroy($process){
		event(new ProcessWasDeleted($process));
		return $process->delete();
	}
}
