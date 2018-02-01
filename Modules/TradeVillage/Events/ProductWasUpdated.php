<?php
	namespace Modules\TradeVillage\Events;

	use Modules\Media\Contracts\StoringMedia;
	use Modules\TradeVillage\Entities\Products;

	class ProductWasUpdated implements StoringMedia
	{
	/**
    * @var Author
    */
    private $product;
    /**
    * @var array
    */
 	private $data;

 	public function __construct(Products $product, array $data)
 	{
 		$this->product = $product;
 		$this->data = $data;
 	}

 	public function getEntity(){
 		return $this->product;
 	}

 	public function getSubmissionData(){
 		return $this->data;
 	}
}
?>