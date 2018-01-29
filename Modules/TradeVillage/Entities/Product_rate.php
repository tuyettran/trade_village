<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product_rate extends Model
{
    use Translatable;

    protected $table = 'tradevillage__product_rates';
    public $translatedAttributes = [];
    protected $fillable = ['value', 'user_id', 'product_id'];
}
