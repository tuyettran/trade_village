<?php
	namespace Modules\TradeVillage\Events;

	use Modules\Media\Contracts\StoringMedia;
	use Modules\TradeVillage\Entities\Artist;

	class ArtistWasUpdated implements StoringMedia
	{
	/**
    * @var Author
    */
    private $artist;
    /**
    * @var array
    */
 	private $data;

 	public function __construct(Artist $artist, array $data)
 	{
 		$this->artist = $artist;
 		$this->data = $data;
 	}

 	public function getEntity(){
 		return $this->artist;
 	}

 	public function getSubmissionData(){
 		return $this->data;
 	}
}
?>