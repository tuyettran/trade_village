<?php

namespace Modules\Tradevillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    use Translatable;

    protected $table = 'tradevillage__lessons';
    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['course_id', 'refer_doc', 'refer_video'];
}
