<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\TradeVillage\Entities\Process;
use Modules\TradeVillage\Entities\Products;
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
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create_new($product)
    {
        return view('tradevillage::admin.processes.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProcessRequest $request
     * @return Response
     */
    public function store(CreateProcessRequest $request, $product)
    {
        $requests = $request->all();
        $requests['product_id'] = $product->id;
        $process = $this->process->create( $requests);
        $path = '/product/process';
        if( !empty($request->file('process-image'))){
            $photo = $request->file('process-image');
            if(substr($photo->getMimeType(), 0, 5) == 'image') {
                    Storage::putFileAs('/public'.$path, $photo, $process->id.$photo->getClientOriginalName());
            }
            $requests['image'] = $path.'/'.$process->id.$photo->getClientOriginalName();
        }
        $process->update($requests);
        return redirect()->route('admin.tradevillage.products.processes', $product->id);
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
        $path = '/product/process';
        $requests = $request->all();
        if( !empty($request->file('process-image'))){
            $photo = $request->file('process-image');
            if(substr($photo->getMimeType(), 0, 5) == 'image') {
                if(file_exists(public_path().$process->image)) {
                    unlink(public_path().$process->image);
                }
                Storage::delete('/public'.$process->image);
                Storage::putFileAs('/public'.$path, $photo, $process->id.$photo->getClientOriginalName());
            }
            $requests['image'] = $path.'/'.$process->id.$photo->getClientOriginalName();
        }
        $this->process->update($process, $requests);

        return redirect()->route('admin.tradevillage.products.processes', $process->product->id);
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

        return redirect()->back();
    }
}
