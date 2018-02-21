<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class Artist extends Model
{
    use Translatable;
    use MediaRelation;

    protected $table = 'tradevillage__artists';
    public $translatedAttributes = ['name', 'description', 'detail', 'address'];
    protected $fillable = ['village_id', 'date_of_birth', 'user_id', 'image', 'contact'];

    public function getFeatureImageAttribute(){
    	return $this->filesByZone('feature_image')->first();
    }

    public function village()
	{
	    return $this->belongsTo("Modules\\TradeVillage\\Entities\\Villages", 'village_id');
	}
}
