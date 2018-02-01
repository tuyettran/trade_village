<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class Events extends Model
{
    use Translatable;
    use MediaRelation;

    protected $table = 'tradevillage__events';
    public $translatedAttributes = ['content', 'title', 'address'];
    protected $fillable = ['village_id', 'image', 'start_time', 'end_time'];
    
    public function getFeatureImageAttribute(){
    	return $this->filesByZone('feature_image')->first();
    }
}
