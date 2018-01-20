<?php

namespace Modules\TradeVillage\Entities;

use Illuminate\Database\Eloquent\Model;

class Product_rateTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'tradevillage__product_rate_translations';
}
