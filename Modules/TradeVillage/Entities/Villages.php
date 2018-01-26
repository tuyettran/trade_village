<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Villages extends Model
{
    use Translatable;

    protected $table = 'tradevillage__villages';
    public $translatedAttributes = [];
    protected $fillable = [];
}