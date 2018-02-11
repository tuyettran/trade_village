<?php

namespace Modules\Tradevillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Tradevillage\Entities\districts;
use Modules\Tradevillage\Http\Requests\CreatedistrictsRequest;
use Modules\Tradevillage\Http\Requests\UpdatedistrictsRequest;
use Modules\Tradevillage\Repositories\districtsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class districtsController extends AdminBaseController
{
    /**
     * @var districtsRepository
     */
    private $districts;

    public function __construct(districtsRepository $districts)
    {
        parent::__construct();

        $this->districts = $districts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$districts = $this->districts->all();

        return view('tradevillage::admin.districts.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.districts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatedistrictsRequest $request
     * @return Response
     */
    public function store(CreatedistrictsRequest $request)
    {
        $this->districts->create($request->all());

        return redirect()->route('admin.tradevillage.districts.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::districts.title.districts')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  districts $districts
     * @return Response
     */
    public function edit(districts $districts)
    {
        return view('tradevillage::admin.districts.edit', compact('districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  districts $districts
     * @param  UpdatedistrictsRequest $request
     * @return Response
     */
    public function update(districts $districts, UpdatedistrictsRequest $request)
    {
        $this->districts->update($districts, $request->all());

        return redirect()->route('admin.tradevillage.districts.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::districts.title.districts')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  districts $districts
     * @return Response
     */
    public function destroy(districts $districts)
    {
        $this->districts->destroy($districts);

        return redirect()->route('admin.tradevillage.districts.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::districts.title.districts')]));
    }
}
