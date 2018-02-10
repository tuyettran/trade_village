<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Edu_course_fields extends Model
{
    protected $table = 'tradevillage__edu_course_fields';
    public $translatedAttributes = [];
    protected $fillable = ['course_id', 'edu_field_id'];
}
