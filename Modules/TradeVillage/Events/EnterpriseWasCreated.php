<?php
    namespace Modules\TradeVillage\Events;

    use Modules\Media\Contracts\StoringMedia;
    use Modules\TradeVillage\Entities\Enterprises  ;

    class EnterpriseWasCreated implements StoringMedia
    {
    /**
    * @var Author
    */
    private $enterprise;
    /**
    * @var array
    */
    private $data;

    public function __construct(Enterprises $enterprise, array $data)
    {
        $this->enterprise = $enterprise;
        $this->data = $data;
    }

    public function getEntity(){
        return $this->enterprise;
    }

    public function getSubmissionData(){
        return $this->data;
    }
}
?>