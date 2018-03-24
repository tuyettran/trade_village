<?php

namespace Modules\TradeVillage\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface ArtistRepository extends BaseRepository
{
	public function getArtistByAttributes(array $attributes);
	public function getAllByVillages(array $village_id, $number);
}
