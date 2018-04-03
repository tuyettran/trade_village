<?php

namespace Modules\TradeVillage\Entities;

use Illuminate\Database\Eloquent\Model;

class LessonsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description'];
    protected $table = 'tradevillage__lessons_translations';
}
