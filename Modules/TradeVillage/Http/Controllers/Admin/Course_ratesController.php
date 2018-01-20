<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Course_rates;
use Modules\TradeVillage\Http\Requests\CreateCourse_ratesRequest;
use Modules\TradeVillage\Http\Requests\UpdateCourse_ratesRequest;
use Modules\TradeVillage\Repositories\Course_ratesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class Course_ratesController extends AdminBaseController
{
    /**
     * @var Course_ratesRepository
     */
    private $course_rates;

    public function __construct(Course_ratesRepository $course_rates)
    {
        parent::__construct();

        $this->course_rates = $course_rates;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$course_rates = $this->course_rates->all();

        return view('tradevillage::admin.course_rates.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.course_rates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCourse_ratesRequest $request
     * @return Response
     */
    public function store(CreateCourse_ratesRequest $request)
    {
        $this->course_rates->create($request->all());

        return redirect()->route('admin.tradevillage.course_rates.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::course_rates.title.course_rates')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Course_rates $course_rates
     * @return Response
     */
    public function edit(Course_rates $course_rates)
    {
        return view('tradevillage::admin.course_rates.edit', compact('course_rates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Course_rates $course_rates
     * @param  UpdateCourse_ratesRequest $request
     * @return Response
     */
    public function update(Course_rates $course_rates, UpdateCourse_ratesRequest $request)
    {
        $this->course_rates->update($course_rates, $request->all());

        return redirect()->route('admin.tradevillage.course_rates.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::course_rates.title.course_rates')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Course_rates $course_rates
     * @return Response
     */
    public function destroy(Course_rates $course_rates)
    {
        $this->course_rates->destroy($course_rates);

        return redirect()->route('admin.tradevillage.course_rates.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::course_rates.title.course_rates')]));
    }
}
