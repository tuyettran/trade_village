<?php
	namespace Modules\TradeVillage\Events;

	use Modules\Media\Contracts\DeletingMedia;
	use Modules\TradeVillage\Entities\Process;

	class ProcessWasDeleted implements DeletingMedia
	{
	/**
    * @var Author
    */
    private $author;
    /**
    * @var array
    */

 	public function __construct(Process $process)
 	{
 		$this->process = $process;
 	}

 	public function getEntityId(){
 		return $this->process->id;
 	}

 	public function getClassName(){
 		return get_class($this->process);
 	}
}
?>