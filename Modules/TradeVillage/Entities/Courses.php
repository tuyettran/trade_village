<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use Translatable;

    protected $table = 'tradevillage__courses';
    public $translatedAttributes = ['name'];
    protected $fillable = ['id'];

    public function documents()
    {
        return $this->hasMany('Modules\\TradeVillage\\Entities\\Documents', 'course_id');
    }

    public function videos()
    {
        return $this->hasMany('Modules\\TradeVillage\\Entities\\Video', 'course_id');
    }

    public function rates()
    {
        return $this->hasMany('Modules\\TradeVillage\\Entities\\Course_rates', 'c');
    }

    public function users()
    {
        $driver = config('asgard.user.users.driver');

        return $this->belongsToMany('Modules\\User\\Entities\\{$driver}\\User', 'tradevillage__course_users', 'c', 'u');
    }

    public function edu_categories()
    {
        return $this->belongsToMany('Modules\\TradeVillage\\Entities\\Edu_fields', 'tradevillage__edu_course_fields', 'c', 'ef');
    }
}
