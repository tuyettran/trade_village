<?php
	namespace Modules\TradeVillage\Events;

	use Modules\Media\Contracts\DeletingMedia;
	use Modules\TradeVillage\Entities\Products;

	class ProductWasDeleted implements DeletingMedia
	{
	/**
    * @var Author
    */
    private $product;
    /**
    * @var array
    */

 	public function __construct(Products $product)
 	{
 		$this->product = $product;
 	}

 	public function getEntityId(){
 		return $this->product->id;
 	}

 	public function getClassName(){
 		return get_class($this->product);
 	}
}
?>