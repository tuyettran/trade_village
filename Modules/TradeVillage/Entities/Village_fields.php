<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Village_fields extends Model
{
    use Translatable;

    protected $table = 'tradevillage__village_fields';
    public $translatedAttributes = [];
    protected $fillable = [];
}
