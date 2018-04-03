<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\Lessons;
use Modules\TradeVillage\Http\Requests\CreateLessonsRequest;
use Modules\TradeVillage\Http\Requests\UpdateLessonsRequest;
use Modules\TradeVillage\Repositories\LessonsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class LessonsController extends AdminBaseController
{
    /**
     * @var LessonsRepository
     */
    private $lessons;

    public function __construct(LessonsRepository $lessons)
    {
        parent::__construct();

        $this->lessons = $lessons;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $lessons = $this->lessons->all();
        $courses = DB::table('tradevillage__courses_translations')->get();

        return view('tradevillage::admin.lessons.index', compact('lessons', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $courses = DB::table('tradevillage__courses_translations')->get();
        return view('tradevillage::admin.lessons.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLessonsRequest $request
     * @return Response
     */
    public function store(CreateLessonsRequest $request)
    {
        $this->lessons->create($request->all());

        return redirect()->route('admin.tradevillage.lessons.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::lessons.title.lessons')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Lessons $lessons
     * @return Response
     */
    public function edit(Lessons $lessons)
    {
        $courses = DB::table('tradevillage__courses_translations')->get();
        return view('tradevillage::admin.lessons.edit', compact('lessons', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Lessons $lessons
     * @param  UpdateLessonsRequest $request
     * @return Response
     */
    public function update(Lessons $lessons, UpdateLessonsRequest $request)
    {
        $this->lessons->update($lessons, $request->all());

        return redirect()->route('admin.tradevillage.lessons.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::lessons.title.lessons')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Lessons $lessons
     * @return Response
     */
    public function destroy(Lessons $lessons)
    {
        $this->lessons->destroy($lessons);

        return redirect()->route('admin.tradevillage.lessons.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::lessons.title.lessons')]));
    }
}
