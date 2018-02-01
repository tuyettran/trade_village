<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use Translatable;

    protected $table = 'tradevillage__courses';
    public $translatedAttributes = ['name'];
    protected $fillable = [];
}
