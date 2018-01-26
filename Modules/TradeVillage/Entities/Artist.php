<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use Translatable;

    protected $table = 'tradevillage__artists';
    public $translatedAttributes = ['name', 'description', 'detail', 'address'];
    protected $fillable = ['village_id', 'date_of_birth', 'user_id', 'image', 'contact'];
}
