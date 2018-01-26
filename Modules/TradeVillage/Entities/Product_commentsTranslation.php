<?php

namespace Modules\TradeVillage\Entities;

use Illuminate\Database\Eloquent\Model;

class Product_commentsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'tradevillage__product_comments_translations';
}
