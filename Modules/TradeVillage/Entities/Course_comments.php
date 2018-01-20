<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Course_comments extends Model
{
    use Translatable;

    protected $table = 'tradevillage__course_comments';
    public $translatedAttributes = [];
    protected $fillable = [];
}
