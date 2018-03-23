<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Villages;
use Modules\TradeVillage\Entities\Village_fields;
use Modules\TradeVillage\Http\Requests\CreateVillagesRequest;
use Modules\TradeVillage\Http\Requests\UpdateVillagesRequest;
use Modules\TradeVillage\Repositories\VillagesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Support\Facades\DB;

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
        $villages = $this->villages->all();
        $categories = DB::table('tradevillage__village_fields_translations')->get();
       
        return view('tradevillage::admin.villages.index', compact('villages','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {   
        $categories = DB::table('tradevillage__village_fields_translations')->get();

        return view('tradevillage::admin.villages.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateVillagesRequest $request
     * @return Response
     */
    public function store(CreateVillagesRequest $request)
    {
        $requests = $request->all();
        if($request->active_home){
            $requests['active_home'] = true;
        }
        $this->villages->create($requests);

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
        $categories = DB::table('tradevillage__village_fields_translations')->get();
        return view('tradevillage::admin.villages.edit', compact('villages', 'categories'));
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
        $requests = $request->all();
        if($request->active_home){
            $requests['active_home'] = true;
        }
        else{
            $requests['active_home'] = false;
        }
        $this->villages->update($villages, $requests);

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
