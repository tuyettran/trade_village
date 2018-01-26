<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Events;
use Modules\TradeVillage\Http\Requests\CreateEventsRequest;
use Modules\TradeVillage\Http\Requests\UpdateEventsRequest;
use Modules\TradeVillage\Repositories\EventsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class EventsController extends AdminBaseController
{
    /**
     * @var EventsRepository
     */
    private $events;

    public function __construct(EventsRepository $events)
    {
        parent::__construct();

        $this->events = $events;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$events = $this->events->all();

        return view('tradevillage::admin.events.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEventsRequest $request
     * @return Response
     */
    public function store(CreateEventsRequest $request)
    {
        $this->events->create($request->all());

        return redirect()->route('admin.tradevillage.events.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::events.title.events')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Events $events
     * @return Response
     */
    public function edit(Events $events)
    {
        return view('tradevillage::admin.events.edit', compact('events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Events $events
     * @param  UpdateEventsRequest $request
     * @return Response
     */
    public function update(Events $events, UpdateEventsRequest $request)
    {
        $this->events->update($events, $request->all());

        return redirect()->route('admin.tradevillage.events.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::events.title.events')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Events $events
     * @return Response
     */
    public function destroy(Events $events)
    {
        $this->events->destroy($events);

        return redirect()->route('admin.tradevillage.events.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::events.title.events')]));
    }
}
