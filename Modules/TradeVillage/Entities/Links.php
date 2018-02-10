<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    use Translatable;

    protected $table = 'tradevillage__links';
    public $translatedAttributes = ['title'];
    protected $fillable = ['village_id', 'link'];
}
