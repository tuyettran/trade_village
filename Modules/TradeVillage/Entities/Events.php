<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use Translatable;

    protected $table = 'tradevillage__events';
    public $translatedAttributes = [];
    protected $fillable = [];
}
