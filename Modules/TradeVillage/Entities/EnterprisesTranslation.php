<?php

namespace Modules\TradeVillage\Entities;

use Illuminate\Database\Eloquent\Model;

class EnterprisesTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'tradevillage__enterprises_translations';
}
