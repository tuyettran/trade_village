<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class Products extends Model
{
    use Translatable;
    use MediaRelation;


    protected $table = 'tradevillage__products';
    public $translatedAttributes = ['name', 'description', 'material', 'detail'];
    protected $fillable = ['enterprise_id', 'images', 'model', 'cost', 'artist_id'];

    public function documents()
    {
        return $this->hasMany('Modules\\TradeVillage\\Entities\\Process', 'product_id');
    }

    public function rates()
    {
        return $this->hasMany('Modules\\TradeVillage\\Entities\\Product_rate', 'p');
    }
}
