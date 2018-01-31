<?php
	namespace Modules\TradeVillage\Events;

	use Modules\Media\Contracts\StoringMedia;
	use Modules\TradeVillage\Entities\Process;

	class ProcessWasUpdated implements StoringMedia
	{
	/**
    * @var Author
    */
    private $process;
    /**
    * @var array
    */
 	private $data;

 	public function __construct(Process $process, array $data)
 	{
 		$this->process = $process;
 		$this->data = $data;
 	}

 	public function getEntity(){
 		return $this->process;
 	}

 	public function getSubmissionData(){
 		return $this->data;
 	}
}
?>