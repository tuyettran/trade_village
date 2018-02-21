<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Course_rates extends Model
{
    use Translatable;

    protected $table = 'tradevillage__course_rates';
    public $translatedAttributes = [];
    protected $fillable = ['value', 'user_id', 'course_id'];

    public function course()
	{
	    return $this->belongsTo("Modules\\TradeVillage\\Entities\\Courses", 'c');
	}
	public function user()
	{
		$driver = config('asgard.user.users.driver');

    	return $this->belongsTo('Modules\\User\\Entities\\{$driver}\\User', 'u');
	}
}
