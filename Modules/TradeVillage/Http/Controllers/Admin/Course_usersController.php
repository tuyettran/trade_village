<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Course_users;
use Modules\TradeVillage\Http\Requests\CreateCourse_usersRequest;
use Modules\TradeVillage\Http\Requests\UpdateCourse_usersRequest;
use Modules\TradeVillage\Repositories\Course_usersRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class Course_usersController extends AdminBaseController
{
    /**
     * @var Course_usersRepository
     */
    private $course_users;

    public function __construct(Course_usersRepository $course_users)
    {
        parent::__construct();

        $this->course_users = $course_users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$course_users = $this->course_users->all();

        return view('tradevillage::admin.course_users.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.course_users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCourse_usersRequest $request
     * @return Response
     */
    public function store(CreateCourse_usersRequest $request)
    {
        $this->course_users->create($request->all());

        return redirect()->route('admin.tradevillage.course_users.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::course_users.title.course_users')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Course_users $course_users
     * @return Response
     */
    public function edit(Course_users $course_users)
    {
        return view('tradevillage::admin.course_users.edit', compact('course_users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Course_users $course_users
     * @param  UpdateCourse_usersRequest $request
     * @return Response
     */
    public function update(Course_users $course_users, UpdateCourse_usersRequest $request)
    {
        $this->course_users->update($course_users, $request->all());

        return redirect()->route('admin.tradevillage.course_users.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::course_users.title.course_users')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Course_users $course_users
     * @return Response
     */
    public function destroy(Course_users $course_users)
    {
        $this->course_users->destroy($course_users);

        return redirect()->route('admin.tradevillage.course_users.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::course_users.title.course_users')]));
    }
}
