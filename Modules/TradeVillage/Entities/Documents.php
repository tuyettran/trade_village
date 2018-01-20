<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use Translatable;

    protected $table = 'tradevillage__documents';
    public $translatedAttributes = [];
    protected $fillable = [];
}
