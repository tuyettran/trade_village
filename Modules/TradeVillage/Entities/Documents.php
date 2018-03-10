<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use Translatable;

    protected $table = 'tradevillage__documents';
    public $translatedAttributes = ['title', 'author', 'description'];
    protected $fillable = ['chapter', 'lesson_id', 'file'];

    public function course()
	{
	    return $this->belongsTo("Modules\\TradeVillage\\Entities\\Courses", 'course_id');
	}
}
