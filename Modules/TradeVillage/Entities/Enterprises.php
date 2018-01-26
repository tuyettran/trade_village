<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Enterprises extends Model
{
    use Translatable;

    protected $table = 'tradevillage__enterprises';
    public $translatedAttributes = ['description', 'name', 'detail', 'address'];
    protected $fillable = ['website', 'image', 'lat', 'lng', 'contact'];
}
