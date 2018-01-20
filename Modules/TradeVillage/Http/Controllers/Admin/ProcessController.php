<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Process;
use Modules\TradeVillage\Http\Requests\CreateProcessRequest;
use Modules\TradeVillage\Http\Requests\UpdateProcessRequest;
use Modules\TradeVillage\Repositories\ProcessRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ProcessController extends AdminBaseController
{
    /**
     * @var ProcessRepository
     */
    private $process;

    public function __construct(ProcessRepository $process)
    {
        parent::__construct();

        $this->process = $process;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$processes = $this->process->all();

        return view('tradevillage::admin.processes.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.processes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProcessRequest $request
     * @return Response
     */
    public function store(CreateProcessRequest $request)
    {
        $this->process->create($request->all());

        return redirect()->route('admin.tradevillage.process.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::processes.title.processes')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Process $process
     * @return Response
     */
    public function edit(Process $process)
    {
        return view('tradevillage::admin.processes.edit', compact('process'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Process $process
     * @param  UpdateProcessRequest $request
     * @return Response
     */
    public function update(Process $process, UpdateProcessRequest $request)
    {
        $this->process->update($process, $request->all());

        return redirect()->route('admin.tradevillage.process.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::processes.title.processes')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Process $process
     * @return Response
     */
    public function destroy(Process $process)
    {
        $this->process->destroy($process);

        return redirect()->route('admin.tradevillage.process.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::processes.title.processes')]));
    }
}
