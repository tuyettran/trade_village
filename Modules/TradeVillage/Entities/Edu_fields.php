<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Edu_fields extends Model
{
    use Translatable;

    protected $table = 'tradevillage__edu_fields';
    public $translatedAttributes = [];
    protected $fillable = [];
}
