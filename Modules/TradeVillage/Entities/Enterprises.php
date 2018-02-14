<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class Enterprises extends Model
{
    use Translatable;
    use MediaRelation;

    protected $table = 'tradevillage__enterprises';
    public $translatedAttributes = ['description', 'name', 'detail', 'address'];
    protected $fillable = ['website', 'image', 'lat', 'lng', 'contact', 'village_id', 'user_id'];

    public function getFeatureImageAttribute(){
    	return $this->filesByZone('feature_image')->first();
    }
}
