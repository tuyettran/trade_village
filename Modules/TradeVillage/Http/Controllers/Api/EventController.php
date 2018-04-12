<?php

namespace Modules\TradeVillage\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\Events;
use Modules\TradeVillage\Entities\Villages;
use Modules\TradeVillage\Entities\Village_fields;
use Modules\TradeVillage\Repositories\EventsRepository;
use Modules\TradeVillage\Repositories\VillagesRepository;
use Modules\Core\Http\Controllers\BasePublicController;

class EventController extends BasePublicController
{
    /**
     * @var ProductsRepository
     */
    private $events;

    public function __construct(EventsRepository $event, Village_fields $category)
    {
        parent::__construct();

        $this->event = $event;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function list()
    {
        $events = $this->event->paginate($perPage = 10);
        $nearest_events = $this->event->nearest_events(8);
        $categories = $this->category->all();
        return Response($events->toJson());
    }

    public function details(Events $event)
    {
        $top_events = $this->event->newest_events(5);
        $similar_events = $event->village->events->take(6);
        return Response($top_events->toJson());
    }
}
