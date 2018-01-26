<?php

namespace Modules\TradeVillage\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'tradevillage__products_translations';
}
