<?php

namespace Modules\Tradevillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Tradevillage\Entities\provinces;
use Modules\Tradevillage\Http\Requests\CreateprovincesRequest;
use Modules\Tradevillage\Http\Requests\UpdateprovincesRequest;
use Modules\Tradevillage\Repositories\provincesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class provincesController extends AdminBaseController
{
    /**
     * @var provincesRepository
     */
    private $provinces;

    public function __construct(provincesRepository $provinces)
    {
        parent::__construct();

        $this->provinces = $provinces;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$provinces = $this->provinces->all();

        return view('tradevillage::admin.provinces.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.provinces.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateprovincesRequest $request
     * @return Response
     */
    public function store(CreateprovincesRequest $request)
    {
        $this->provinces->create($request->all());

        return redirect()->route('admin.tradevillage.provinces.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::provinces.title.provinces')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  provinces $provinces
     * @return Response
     */
    public function edit(provinces $provinces)
    {
        return view('tradevillage::admin.provinces.edit', compact('provinces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  provinces $provinces
     * @param  UpdateprovincesRequest $request
     * @return Response
     */
    public function update(provinces $provinces, UpdateprovincesRequest $request)
    {
        $this->provinces->update($provinces, $request->all());

        return redirect()->route('admin.tradevillage.provinces.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::provinces.title.provinces')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  provinces $provinces
     * @return Response
     */
    public function destroy(provinces $provinces)
    {
        $this->provinces->destroy($provinces);

        return redirect()->route('admin.tradevillage.provinces.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::provinces.title.provinces')]));
    }
}
