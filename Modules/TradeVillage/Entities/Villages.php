<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class Villages extends Model
{
    use Translatable;
    use MediaRelation;

    protected $table = 'tradevillage__villages';
    public $translatedAttributes = ['name', 'description', 'story', 'detail'];
    protected $fillable = ['category_id', 'image', 'visitor_counter', 'district', 'province'];

    public function getImageVillageAttribute(){
    	return $this->filesByZone('image_village')->first();
    }
}
