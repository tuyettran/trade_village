<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use Translatable;

    protected $table = 'tradevillage__videos';
    public $translatedAttributes = ['name', 'author'];
    protected $fillable = ['link', 'course_id', 'chapter'];

    public function course()
	{
	    return $this->belongsTo("Modules\\TradeVillage\\Entities\\Courses", 'course_id');
	}
}
