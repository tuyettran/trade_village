<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use Translatable;

    protected $table = 'tradevillage__processes';
    public $translatedAttributes = [];
    protected $fillable = [];
}
