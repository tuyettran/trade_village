<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class News extends Model
{
    use Translatable;
    use MediaRelation;

    protected $table = 'tradevillage__news';
    public $translatedAttributes = ['title', 'content'];
    protected $fillable = ['village_id', 'image'];

    public function getFeatureImageAttribute()
    {
        return $this->filesByZone('feature_image')->first();
    }

    public function village()
    {
        return $this->belongsTo("Modules\\TradeVillage\\Entities\\Villages", 'village_id');
    }
}
