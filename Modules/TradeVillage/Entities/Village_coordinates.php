<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Village_coordinates extends Model
{
    use Translatable;

    protected $table = 'tradevillage__village_coordinates';
    public $translatedAttributes = [];
    protected $fillable = ['village_id', 'lat', 'lng'];
}
