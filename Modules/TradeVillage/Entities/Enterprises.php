<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Enterprises extends Model
{
    use Translatable;

    protected $table = 'tradevillage__enterprises';
    public $translatedAttributes = [];
    protected $fillable = [];
}
