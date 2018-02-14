<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\Enterprises;
use Modules\TradeVillage\Http\Requests\CreateEnterprisesRequest;
use Modules\TradeVillage\Http\Requests\UpdateEnterprisesRequest;
use Modules\TradeVillage\Repositories\EnterprisesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class EnterprisesController extends AdminBaseController
{
    /**
     * @var EnterprisesRepository
     */
    private $enterprises;

    public function __construct(EnterprisesRepository $enterprises)
    {
        parent::__construct();

        $this->enterprises = $enterprises;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $enterprises = $this->enterprises->all();
        $users = DB::table('users')->get();
        $villages = DB::table('tradevillage__villages_translations')->get();

        return view('tradevillage::admin.enterprises.index', compact('enterprises', 'users', 'villages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = DB::table('users')->get();
        $villages = DB::table('tradevillage__villages_translations')->get();
        return view('tradevillage::admin.enterprises.create', compact('users', 'villages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEnterprisesRequest $request
     * @return Response
     */
    public function store(CreateEnterprisesRequest $request)
    {
        $this->enterprises->create($request->all());

        return redirect()->route('admin.tradevillage.enterprises.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::enterprises.title.enterprises')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Enterprises $enterprises
     * @return Response
     */
    public function edit(Enterprises $enterprises)
    {
        $users = DB::table('users')->get();
        $villages = DB::table('tradevillage__villages_translations')->get();
        return view('tradevillage::admin.enterprises.edit', compact('enterprises', 'users', 'villages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Enterprises $enterprises
     * @param  UpdateEnterprisesRequest $request
     * @return Response
     */
    public function update(Enterprises $enterprises, UpdateEnterprisesRequest $request)
    {
        $this->enterprises->update($enterprises, $request->all());

        return redirect()->route('admin.tradevillage.enterprises.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::enterprises.title.enterprises')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Enterprises $enterprises
     * @return Response
     */
    public function destroy(Enterprises $enterprises)
    {
        $this->enterprises->destroy($enterprises);

        return redirect()->route('admin.tradevillage.enterprises.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::enterprises.title.enterprises')]));
    }
}
