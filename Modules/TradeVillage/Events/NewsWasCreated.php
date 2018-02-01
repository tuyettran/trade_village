<?php
    namespace Modules\TradeVillage\Events;

    use Modules\Media\Contracts\StoringMedia;
    use Modules\TradeVillage\Entities\News  ;

    class NewsWasCreated implements StoringMedia
    {
    /**
    * @var Author
    */
    private $new;
    /**
    * @var array
    */
    private $data;

    public function __construct(News $new, array $data)
    {
        $this->new = $new;
        $this->data = $data;
    }

    public function getEntity(){
        return $this->new;
    }

    public function getSubmissionData(){
        return $this->data;
    }
}
?>