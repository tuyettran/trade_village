<?php

namespace Modules\TradeVillage\Entities;

use Illuminate\Database\Eloquent\Model;

class EventsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['content', 'title', 'address', 'locale', 'events_id'];
    protected $table = 'tradevillage__events_translations';
}
