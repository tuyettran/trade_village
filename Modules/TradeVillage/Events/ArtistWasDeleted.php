<?php
	namespace Modules\TradeVillage\Events;

	use Modules\Media\Contracts\DeletingMedia;
	use Modules\TradeVillage\Entities\Artist;

	class ArtistWasDeleted implements DeletingMedia
	{
	/**
    * @var Author
    */
    private $artist;
    /**
    * @var array
    */

 	public function __construct(Artist $artist)
 	{
 		$this->artist = $artist;
 	}

 	public function getEntityId(){
 		return $this->artist->id;
 	}

 	public function getClassName(){
 		return get_class($this->artist);
 	}
}
?>