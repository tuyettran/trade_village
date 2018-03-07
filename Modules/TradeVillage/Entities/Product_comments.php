<?php

namespace Modules\TradeVillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product_comments extends Model
{
    protected $table = 'tradevillage__product_comments';
    protected $fillable = ['user_id', 'product_id', 'content'];

    public function product()
	{
	    return $this->belongsTo("Modules\\TradeVillage\\Entities\\Products", 'product_id');
	}

	public function user()
	{
		$driver = config('asgard.user.config.driver');

    	return $this->belongsTo('Modules\\User\\Entities\\'.$driver.'\\User', 'user_id');
	}
}
