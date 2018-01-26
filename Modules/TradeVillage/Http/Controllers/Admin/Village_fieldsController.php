<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Village_fields;
use Modules\TradeVillage\Http\Requests\CreateVillage_fieldsRequest;
use Modules\TradeVillage\Http\Requests\UpdateVillage_fieldsRequest;
use Modules\TradeVillage\Repositories\Village_fieldsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class Village_fieldsController extends AdminBaseController
{
    /**
     * @var Village_fieldsRepository
     */
    private $village_fields;

    public function __construct(Village_fieldsRepository $village_fields)
    {
        parent::__construct();

        $this->village_fields = $village_fields;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$village_fields = $this->village_fields->all();

        return view('tradevillage::admin.village_fields.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.village_fields.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateVillage_fieldsRequest $request
     * @return Response
     */
    public function store(CreateVillage_fieldsRequest $request)
    {
        $this->village_fields->create($request->all());

        return redirect()->route('admin.tradevillage.village_fields.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::village_fields.title.village_fields')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Village_fields $village_fields
     * @return Response
     */
    public function edit(Village_fields $village_fields)
    {
        return view('tradevillage::admin.village_fields.edit', compact('village_fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Village_fields $village_fields
     * @param  UpdateVillage_fieldsRequest $request
     * @return Response
     */
    public function update(Village_fields $village_fields, UpdateVillage_fieldsRequest $request)
    {
        $this->village_fields->update($village_fields, $request->all());

        return redirect()->route('admin.tradevillage.village_fields.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::village_fields.title.village_fields')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Village_fields $village_fields
     * @return Response
     */
    public function destroy(Village_fields $village_fields)
    {
        $this->village_fields->destroy($village_fields);

        return redirect()->route('admin.tradevillage.village_fields.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::village_fields.title.village_fields')]));
    }
}
