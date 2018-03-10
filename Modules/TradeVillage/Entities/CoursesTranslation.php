<?php

namespace Modules\TradeVillage\Entities;

use Illuminate\Database\Eloquent\Model;

class CoursesTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'author'];
    protected $table = 'tradevillage__courses_translations';
}
