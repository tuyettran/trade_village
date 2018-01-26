<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use Translatable;

    protected $table = 'tradevillage__artists';
    public $translatedAttributes = [];
    protected $fillable = [];
}
