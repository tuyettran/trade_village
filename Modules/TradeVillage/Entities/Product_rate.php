<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product_rate extends Model
{
    protected $table = 'tradevillage__product_rates';
    public $translatedAttributes = [];
    protected $fillable = ['value', 'user_id', 'product_id'];

    public function product()
	{
	    return $this->belongsTo("Modules\\TradeVillage\\Entities\\Products", 'product_id');
	}

	public function user()
	{
		$driver = config('asgard.user.users.driver');

    	return $this->belongsTo('Modules\\User\\Entities\\{$driver}\\User', 'user_id');
	}
}
