<?php

namespace Modules\TradeVillage\Entities;

use Illuminate\Database\Eloquent\Model;

class VillagesTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'story', 'detail', 'address'];
    protected $table = 'tradevillage__villages_translations';
}
