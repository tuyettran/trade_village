<?php

namespace Modules\TradeVillage\Entities;

use Modules\Media\Support\Traits\MediaRelation;
use Illuminate\Database\Eloquent\Model;

class ProcessTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['description', 'process_id', 'locale', 'title'];
    protected $table = 'tradevillage__process_translations';
}
