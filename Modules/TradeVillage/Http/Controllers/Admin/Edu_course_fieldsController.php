<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\Edu_course_fields;
use Modules\TradeVillage\Http\Requests\CreateEdu_course_fieldsRequest;
use Modules\TradeVillage\Http\Requests\UpdateEdu_course_fieldsRequest;
use Modules\TradeVillage\Repositories\Edu_course_fieldsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class Edu_course_fieldsController extends AdminBaseController
{
    /**
     * @var Edu_course_fieldsRepository
     */
    private $edu_course_fields;

    public function __construct(Edu_course_fieldsRepository $edu_course_fields)
    {
        parent::__construct();

        $this->edu_course_fields = $edu_course_fields;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $edu_course_fields = $this->edu_course_fields->all();
        $courses = DB::table('tradevillage__courses_translations')->get();
        $edu_fields = DB::table('tradevillage__edu_fields_translations')->get();
        return view('tradevillage::admin.edu_course_fields.index', compact('edu_course_fields', 'courses', 'edu_fields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $courses = DB::table('tradevillage__courses_translations')->get();
        $edu_fields = DB::table('tradevillage__edu_fields_translations')->get();
        return view('tradevillage::admin.edu_course_fields.create', compact('courses','edu_fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEdu_course_fieldsRequest $request
     * @return Response
     */
    public function store(CreateEdu_course_fieldsRequest $request)
    {
        $this->edu_course_fields->create($request->all());

        return redirect()->route('admin.tradevillage.edu_course_fields.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::edu_course_fields.title.edu_course_fields')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Edu_course_fields $edu_course_fields
     * @return Response
     */
    public function edit(Edu_course_fields $edu_course_field)
    {
        $courses = DB::table('tradevillage__courses_translations')->get();
        $edu_fields = DB::table('tradevillage__edu_fields_translations')->get();
        return view('tradevillage::admin.edu_course_fields.edit', compact('edu_course_field', 'edu_fields', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Edu_course_fields $edu_course_fields
     * @param  UpdateEdu_course_fieldsRequest $request
     * @return Response
     */
    public function update(Edu_course_fields $edu_course_fields, UpdateEdu_course_fieldsRequest $request)
    {
        $this->edu_course_fields->update($edu_course_fields, $request->all());

        return redirect()->route('admin.tradevillage.edu_course_fields.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::edu_course_fields.title.edu_course_fields')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Edu_course_fields $edu_course_fields
     * @return Response
     */
    public function destroy(Edu_course_fields $edu_course_fields)
    {
        $this->edu_course_fields->destroy($edu_course_fields);

        return redirect()->route('admin.tradevillage.edu_course_fields.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::edu_course_fields.title.edu_course_fields')]));
    }
}
