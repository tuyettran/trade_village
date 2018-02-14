<?php
	namespace Modules\TradeVillage\Events;

	use Modules\Media\Contracts\DeletingMedia;
	use Modules\TradeVillage\Entities\Enterprises;

	class EnterpriseWasDeleted implements DeletingMedia
	{
	/**
    * @var Author
    */
    private $enterprise;
    /**
    * @var array
    */

 	public function __construct(Enterprises $enterprise)
 	{
 		$this->enterprise = $enterprise;
 	}

 	public function getEntityId(){
 		return $this->enterprise->id;
 	}

 	public function getClassName(){
 		return get_class($this->enterprise);
 	}
}
?>