<?php

namespace Modules\TradeVillage\Repositories\Eloquent;

use Modules\TradeVillage\Repositories\ArtistRepository;
use Modules\TradeVillage\Events\ArtistWasUpdated;
use Modules\TradeVillage\Events\ArtistWasDeleted;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentArtistRepository extends EloquentBaseRepository implements ArtistRepository
{
	public function create($data){
		$artist = $this->model->create($data);
		event(new ArtistWasUpdated($artist, $data));
		return $artist;
	}

	public function update($artist, $data){
		$artist->update($data);
		event(new ArtistWasUpdated($artist, $data));
		return $artist;
	}

	public function destroy($artist){
		event(new ArtistWasDeleted($artist));
		return $artist->delete();
	}
}
