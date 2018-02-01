<?php
    namespace Modules\TradeVillage\Events;

    use Modules\Media\Contracts\DeletingMedia;
    use Modules\TradeVillage\Entities\News;

    class NewsWasDeleted implements DeletingMedia
    {
    /**
    * @var Author
    */
    private $new;
    /**
    * @var array
    */

    public function __construct(News $new)
    {
        $this->new = $new;
    }

    public function getEntityId(){
        return $this->new->id;
    }

    public function getClassName(){
        return get_class($this->new);
    }
}
?>