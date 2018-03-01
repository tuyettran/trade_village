<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Village_fields extends Model
{
    use Translatable;

    protected $table = 'tradevillage__village_fields';
    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['id'];

    public function villages()
    {
        return $this->hasMany('Modules\\TradeVillage\\Entities\\Villages', 'category_id');
    }

    public function products()
    {
        return $this->hasMany('Modules\\TradeVillage\\Entities\\Products', 'category_id');
    }
}
