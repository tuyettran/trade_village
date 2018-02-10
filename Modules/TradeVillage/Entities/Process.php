<?php

namespace Modules\TradeVillage\Entities;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class Process extends Model
{
    use Translatable;
    use MediaRelation;

    protected $table = 'tradevillage__processes';
    public $translatedAttributes = ['description', 'title'];
    protected $fillable = ['product_id', 'image', 'step'];

    public function getFeatureImageAttribute(){
    	return $this->filesByZone('feature_image')->first();
    }
}
