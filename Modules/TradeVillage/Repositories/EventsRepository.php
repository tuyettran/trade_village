<?php

namespace Modules\TradeVillage\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface EventsRepository extends BaseRepository
{
	public function newest_events($number);
	public function nearest_events($number);
	public function getEventsByAttributes(array $attributes);
}
