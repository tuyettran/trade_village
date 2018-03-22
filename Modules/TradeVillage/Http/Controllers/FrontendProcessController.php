<?php

namespace Modules\TradeVillage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Modules\TradeVillage\Entities\Process;
use Modules\TradeVillage\Entities\Products;
use Modules\TradeVillage\Http\Requests\CreateProcessRequest;
use Modules\TradeVillage\Http\Requests\UpdateProcessRequest;
use Modules\TradeVillage\Repositories\ProcessRepository;
use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\User\Repositories\UserRespository;

class FrontendProcessController extends BasePublicController
{
    /**
     * @var ProcesssRepository
     */
    private $processes;

    public function __construct(ProcessRepository $processes, ProductsRepository $products)
    {
        parent::__construct();

        $this->processes = $processes;
        $this->products = $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProcesssRequest $request
     * @return Response
     */

    public function store(CreateProcessRequest $request, $product)
    {
        $requests = $request->all();
        $requests['product_id'] = $product->id;
        $process = $this->processes->create( $requests);
        $path = '/product/process';
        if( !empty($request->file('process-image'))){
            $photo = $request->file('process-image');
            if(substr($photo->getMimeType(), 0, 5) == 'image') {
                    Storage::putFileAs('/public'.$path, $photo, $process->id.$photo->getClientOriginalName());
            }
            $requests['image'] = $path.'/'.$process->id.$photo->getClientOriginalName();
        }
        $process->update($requests);
        return redirect()->route('frontend.tradevillage.products.processes', $product->id);
    }


    public function process(Products $product)
    {
        $processes = $this->processes->getByAttributes(['product_id' => $product->id], $orderBy = 'step', $sortOrder = 'asc');
        return view('tradevillage::frontend.villages.products.processes', compact('processes', 'product'));
    } 
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Processs $processes
     * @return Response
     */
    public function edit(Process $process, $product)
    {
        if (Gate::denies('update-product', $product)) {
            abort(403);
        }
        return view('tradevillage::frontend.villages.processes.edit', compact('product', 'process'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Processs $processes
     * @param  UpdateProcesssRequest $request
     * @return Response
     */
    public function update(Process $process, UpdateProcessRequest $request,Products $product)
    {
        
        if (Gate::denies('update-product', $product)) {
            abort(403);
        }

        $path = '/product/process';
        $requests = $request->all();
        $requests['product_id'] = $product->id;
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
        $this->processes->update($process, $requests);
        return redirect()->route('frontend.tradevillage.products.processes', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Processs $processes
     * @return Response
     */
    public function destroy(Process $process, Products $product)
    {
        if (Gate::denies('update-product', $product)) {
            abort(403);
        }
        $this->processes->destroy($process);
        return redirect()->route('frontend.tradevillage.products.index');
    }
}
