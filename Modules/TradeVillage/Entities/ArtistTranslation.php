<?php

namespace Modules\TradeVillage\Entities;

use Illuminate\Database\Eloquent\Model;

class ArtistTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'tradevillage__artist_translations';
}
