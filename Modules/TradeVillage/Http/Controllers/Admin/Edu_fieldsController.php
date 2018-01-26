<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Edu_fields;
use Modules\TradeVillage\Http\Requests\CreateEdu_fieldsRequest;
use Modules\TradeVillage\Http\Requests\UpdateEdu_fieldsRequest;
use Modules\TradeVillage\Repositories\Edu_fieldsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class Edu_fieldsController extends AdminBaseController
{
    /**
     * @var Edu_fieldsRepository
     */
    private $edu_fields;

    public function __construct(Edu_fieldsRepository $edu_fields)
    {
        parent::__construct();

        $this->edu_fields = $edu_fields;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$edu_fields = $this->edu_fields->all();

        return view('tradevillage::admin.edu_fields.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.edu_fields.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEdu_fieldsRequest $request
     * @return Response
     */
    public function store(CreateEdu_fieldsRequest $request)
    {
        $this->edu_fields->create($request->all());

        return redirect()->route('admin.tradevillage.edu_fields.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::edu_fields.title.edu_fields')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Edu_fields $edu_fields
     * @return Response
     */
    public function edit(Edu_fields $edu_fields)
    {
        return view('tradevillage::admin.edu_fields.edit', compact('edu_fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Edu_fields $edu_fields
     * @param  UpdateEdu_fieldsRequest $request
     * @return Response
     */
    public function update(Edu_fields $edu_fields, UpdateEdu_fieldsRequest $request)
    {
        $this->edu_fields->update($edu_fields, $request->all());

        return redirect()->route('admin.tradevillage.edu_fields.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::edu_fields.title.edu_fields')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Edu_fields $edu_fields
     * @return Response
     */
    public function destroy(Edu_fields $edu_fields)
    {
        $this->edu_fields->destroy($edu_fields);

        return redirect()->route('admin.tradevillage.edu_fields.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::edu_fields.title.edu_fields')]));
    }
}
