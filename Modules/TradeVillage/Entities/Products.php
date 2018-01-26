<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use Translatable;

    protected $table = 'tradevillage__products';
    public $translatedAttributes = ['name', 'description', 'material', 'detail'];
    protected $fillable = ['enterprise_id', 'image', '3D_image', 'cost', 'artist_id'];
}
