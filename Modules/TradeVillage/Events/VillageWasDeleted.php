<?php
	namespace Modules\TradeVillage\Events;

	use Modules\Media\Contracts\DeletingMedia;
	use Modules\TradeVillage\Entities\Villages;

	class VillageWasDeleted implements DeletingMedia
	{
	/**
    * @var Author
    */
    private $village;
    /**
    * @var array
    */

 	public function __construct(Villages $village)
 	{
 		$this->village = $village;
 	}

 	public function getEntityId(){
 		return $this->village->id;
 	}

 	public function getClassName(){
 		return get_class($this->village);
 	}
}
?>