<?php
	namespace Modules\TradeVillage\Events;

	use Modules\Media\Contracts\StoringMedia;
	use Modules\TradeVillage\Entities\Villages;

	class VillageWasUpdated implements StoringMedia
	{
	/**
    * @var Author
    */
    private $village;
    /**
    * @var array
    */
 	private $data;

 	public function __construct(Villages $village, array $data)
 	{
 		$this->village = $village;
 		$this->data = $data;
 	}

 	public function getEntity(){
 		return $this->village;
 	}

 	public function getSubmissionData(){
 		return $this->data;
 	}
}
?>