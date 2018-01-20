<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Courses;
use Modules\TradeVillage\Http\Requests\CreateCoursesRequest;
use Modules\TradeVillage\Http\Requests\UpdateCoursesRequest;
use Modules\TradeVillage\Repositories\CoursesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CoursesController extends AdminBaseController
{
    /**
     * @var CoursesRepository
     */
    private $courses;

    public function __construct(CoursesRepository $courses)
    {
        parent::__construct();

        $this->courses = $courses;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$courses = $this->courses->all();

        return view('tradevillage::admin.courses.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCoursesRequest $request
     * @return Response
     */
    public function store(CreateCoursesRequest $request)
    {
        $this->courses->create($request->all());

        return redirect()->route('admin.tradevillage.courses.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::courses.title.courses')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Courses $courses
     * @return Response
     */
    public function edit(Courses $courses)
    {
        return view('tradevillage::admin.courses.edit', compact('courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Courses $courses
     * @param  UpdateCoursesRequest $request
     * @return Response
     */
    public function update(Courses $courses, UpdateCoursesRequest $request)
    {
        $this->courses->update($courses, $request->all());

        return redirect()->route('admin.tradevillage.courses.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::courses.title.courses')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Courses $courses
     * @return Response
     */
    public function destroy(Courses $courses)
    {
        $this->courses->destroy($courses);

        return redirect()->route('admin.tradevillage.courses.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::courses.title.courses')]));
    }
}
