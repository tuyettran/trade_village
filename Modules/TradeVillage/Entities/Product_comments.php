<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product_comments extends Model
{
    use Translatable;

    protected $table = 'tradevillage__product_comments';
    public $translatedAttributes = ['content'];
    protected $fillable = ['user_id', 'product_id'];
}
