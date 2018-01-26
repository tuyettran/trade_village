<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Edu_course_fields extends Model
{
    use Translatable;

    protected $table = 'tradevillage__edu_course_fields';
    public $translatedAttributes = ['course_id', 'edu_field_id'];
    protected $fillable = [];
}
