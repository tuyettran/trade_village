<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Villages;
use Modules\TradeVillage\Http\Requests\CreateVillagesRequest;
use Modules\TradeVillage\Http\Requests\UpdateVillagesRequest;
use Modules\TradeVillage\Repositories\VillagesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class VillagesController extends AdminBaseController
{
    /**
     * @var VillagesRepository
     */
    private $villages;

    public function __construct(VillagesRepository $villages)
    {
        parent::__construct();

        $this->villages = $villages;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$villages = $this->villages->all();

        return view('tradevillage::admin.villages.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.villages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateVillagesRequest $request
     * @return Response
     */
    public function store(CreateVillagesRequest $request)
    {
        $this->villages->create($request->all());

        return redirect()->route('admin.tradevillage.villages.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::villages.title.villages')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Villages $villages
     * @return Response
     */
    public function edit(Villages $villages)
    {
        return view('tradevillage::admin.villages.edit', compact('villages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Villages $villages
     * @param  UpdateVillagesRequest $request
     * @return Response
     */
    public function update(Villages $villages, UpdateVillagesRequest $request)
    {
        $this->villages->update($villages, $request->all());

        return redirect()->route('admin.tradevillage.villages.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::villages.title.villages')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Villages $villages
     * @return Response
     */
    public function destroy(Villages $villages)
    {
        $this->villages->destroy($villages);

        return redirect()->route('admin.tradevillage.villages.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::villages.title.villages')]));
    }
}
