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

	public function getArtistByAttributes(array $attributes){
		$query = $this->buildQueryByAttributes($attributes);

        return $query;
	}

	public function getAllByVillages(array $village_id, $number){
        $query = $this->model->query();
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->whereIn('village_id', $village_id)->limit($number)->get();
        }
        return $this->model->whereIn('village_id', $village_id)->limit($number)->get();
    }

    public function search($key, $locale){
    	$query = $this->model->query();
    	if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')
            ->whereHas('translations', function ($query) use ($locale, $key) {
            	$query->where('locale', $locale)->where('name', 'like', '%'.$key.'%')->orWhere('description', 'like', '%'.$key.'%');
        	})->get();
        }
        return $this->model->where('id', '=', '1')->get();
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
