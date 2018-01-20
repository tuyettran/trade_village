<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use Translatable;

    protected $table = 'tradevillage__products';
    public $translatedAttributes = [];
    protected $fillable = [];
}
