<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use Translatable;

    protected $table = 'tradevillage__videos';
    public $translatedAttributes = [];
    protected $fillable = [];
}
