<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\Course_comments;
use Modules\TradeVillage\Entities\Courses;
use Modules\TradeVillage\Http\Requests\CreateCourse_commentsRequest;
use Modules\TradeVillage\Http\Requests\UpdateCourse_commentsRequest;
use Modules\TradeVillage\Repositories\Course_commentsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class Course_commentsController extends AdminBaseController
{
    /**
     * @var Course_commentsRepository
     */
    private $course_comments;

    public function __construct(Course_commentsRepository $course_comments)
    {
        parent::__construct();

        $this->course_comments = $course_comments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $course_comments = $this->course_comments->all();
        $users = DB::table('users')->get();
        $courses = DB::table('tradevillage__courses_translations')->get();

        return view('tradevillage::admin.course_comments.index', compact('course_comments', 'users', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.course_comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCourse_commentsRequest $request
     * @return Response
     */
    public function store(CreateCourse_commentsRequest $request)
    {
        $this->course_comments->create($request->all());

        return redirect()->route('admin.tradevillage.course_comments.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::course_comments.title.course_comments')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Course_comments $course_comments
     * @return Response
     */
    public function edit(Course_comments $course_comments)
    {
        return view('tradevillage::admin.course_comments.edit', compact('course_comments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Course_comments $course_comments
     * @param  UpdateCourse_commentsRequest $request
     * @return Response
     */
    public function update(Course_comments $course_comments, UpdateCourse_commentsRequest $request)
    {
        $this->course_comments->update($course_comments, $request->all());

        return redirect()->route('admin.tradevillage.course_comments.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::course_comments.title.course_comments')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Course_comments $course_comments
     * @return Response
     */
    public function destroy(Course_comments $course_comments)
    {
        $this->course_comments->destroy($course_comments);

        return redirect()->route('admin.tradevillage.course_comments.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::course_comments.title.course_comments')]));
    }
}
