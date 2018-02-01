<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Course_users extends Model
{
    use Translatable;

    protected $table = 'tradevillage__course_users';
    public $translatedAttributes = [];
    protected $fillable = ['course_id', 'user_id', 'chapter'];
}
