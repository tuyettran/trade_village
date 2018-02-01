<?php

namespace Modules\TradeVillage\Entities;

use Illuminate\Database\Eloquent\Model;

class LinksTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];
    protected $table = 'tradevillage__links_translations';
}
