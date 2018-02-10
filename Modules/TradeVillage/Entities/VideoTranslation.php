<?php

namespace Modules\TradeVillage\Entities;

use Illuminate\Database\Eloquent\Model;

class VideoTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'author', 'locale', 'course_id'];
    protected $table = 'tradevillage__video_translations';
}
