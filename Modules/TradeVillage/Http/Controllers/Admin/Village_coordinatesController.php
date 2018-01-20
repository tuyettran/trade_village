<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Village_coordinates;
use Modules\TradeVillage\Http\Requests\CreateVillage_coordinatesRequest;
use Modules\TradeVillage\Http\Requests\UpdateVillage_coordinatesRequest;
use Modules\TradeVillage\Repositories\Village_coordinatesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class Village_coordinatesController extends AdminBaseController
{
    /**
     * @var Village_coordinatesRepository
     */
    private $village_coordinates;

    public function __construct(Village_coordinatesRepository $village_coordinates)
    {
        parent::__construct();

        $this->village_coordinates = $village_coordinates;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$village_coordinates = $this->village_coordinates->all();

        return view('tradevillage::admin.village_coordinates.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.village_coordinates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateVillage_coordinatesRequest $request
     * @return Response
     */
    public function store(CreateVillage_coordinatesRequest $request)
    {
        $this->village_coordinates->create($request->all());

        return redirect()->route('admin.tradevillage.village_coordinates.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::village_coordinates.title.village_coordinates')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Village_coordinates $village_coordinates
     * @return Response
     */
    public function edit(Village_coordinates $village_coordinates)
    {
        return view('tradevillage::admin.village_coordinates.edit', compact('village_coordinates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Village_coordinates $village_coordinates
     * @param  UpdateVillage_coordinatesRequest $request
     * @return Response
     */
    public function update(Village_coordinates $village_coordinates, UpdateVillage_coordinatesRequest $request)
    {
        $this->village_coordinates->update($village_coordinates, $request->all());

        return redirect()->route('admin.tradevillage.village_coordinates.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::village_coordinates.title.village_coordinates')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Village_coordinates $village_coordinates
     * @return Response
     */
    public function destroy(Village_coordinates $village_coordinates)
    {
        $this->village_coordinates->destroy($village_coordinates);

        return redirect()->route('admin.tradevillage.village_coordinates.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::village_coordinates.title.village_coordinates')]));
    }
}
