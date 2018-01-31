<?php
	namespace Modules\TradeVillage\Events;

	use Modules\Media\Contracts\DeletingMedia;
	use Modules\TradeVillage\Entities\Events;

	class EventWasDeleted implements DeletingMedia
	{
	/**
    * @var Author
    */
    private $event;
    /**
    * @var array
    */

 	public function __construct(Events $event)
 	{
 		$this->event = $event;
 	}

 	public function getEntityId(){
 		return $this->event->id;
 	}

 	public function getClassName(){
 		return get_class($this->event);
 	}
}
?>