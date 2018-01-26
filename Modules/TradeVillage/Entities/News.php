<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use Translatable;

    protected $table = 'tradevillage__news';
    public $translatedAttributes = ['title', 'content'];
    protected $fillable = ['village_id', 'image'];
}
