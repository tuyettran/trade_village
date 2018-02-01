<?php
	namespace Modules\TradeVillage\Events;

	use Modules\Media\Contracts\StoringMedia;
	use Modules\TradeVillage\Entities\Events;

	class EventWasUpdated implements StoringMedia
	{
	/**
    * @var Author
    */
    private $event;
    /**
    * @var array
    */
 	private $data;

 	public function __construct(Events $event, array $data)
 	{
 		$this->event = $event;
 		$this->data = $data;
 	}

 	public function getEntity(){
 		return $this->event;
 	}

 	public function getSubmissionData(){
 		return $this->data;
 	}
}
?>