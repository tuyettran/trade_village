<?php

namespace Modules\TradeVillage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\Products;
use Modules\TradeVillage\Http\Requests\CreateProductsRequest;
use Modules\TradeVillage\Http\Requests\UpdateProductsRequest;
use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\Core\Http\Controllers\BasePublicController;

class FrontendProductController extends BasePublicController
{
    /**
     * @var ProductsRepository
     */
    private $products;

    public function __construct(ProductsRepository $products)
    {
        parent::__construct();

        $this->products = $products;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = $this->products->all();
        return view('tradevillage::frontend.villages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $artists = DB::table('tradevillage__artist_translations')->get();
        $enterprises = DB::table('tradevillage__enterprises_translations')->get();
        return view('tradevillage::frontend.villages.products.create', compact('artists', 'enterprises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductsRequest $request
     * @return Response
     */
    public function store(CreateProductsRequest $request)
    {
        $requests = $request->all();
        $product = $this->products->create( $requests);
        $path = '/public/products/'.$product->id;
        if( !empty($request->file('file'))){
            foreach ($request->file('file') as $photo) {
                if(substr($photo->getMimeType(), 0, 5) == 'image') {
                    Storage::putFileAs($path, $photo, $photo->getClientOriginalName());
                }
            }
            $requests['model'] = $path; 
            $product->update($requests);  
        } 
        return redirect()->route('admin.tradevillage.products.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::products.title.products')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Products $products
     * @return Response
     */
    public function edit(Products $product)
    {
        if(!empty($product->model)){
            $files = Storage::files($product->model);
        }
        if(!empty($product->images)){
            $images = Storage::files($product->images);
        }
        
        return view('tradevillage::frontend.villages.products.edit', compact('product', 'files', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Products $products
     * @param  UpdateProductsRequest $request
     * @return Response
     */
    public function update(Products $products, UpdateProductsRequest $request)
    {
        $requests = $request->all();
        $path = '/public/products/'.$products->id;
        if( !empty($request->delete_model)){
            if(!empty($products->model))
                Storage::deleteDirectory($products->model);

            $requests['model'] = '';
        }
        if( !empty($request->file('file'))){
            if(!empty($products->model)){
                Storage::deleteDirectory($products->model);
            }
            foreach ($request->file('file') as $photo) {
                if(substr($photo->getMimeType(), 0, 5) == 'image') {
                    Storage::putFileAs($path, $photo, $photo->getClientOriginalName());  
                }
            }
            $requests['model'] = $path;
        }
        $this->products->update($products, $requests);
        return redirect()->route('admin.tradevillage.products.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::products.title.products')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Products $products
     * @return Response
     */
    public function destroy(Products $products)
    {
        if( !empty($products->model)){
            Storage::deleteDirectory($products->model);
        }
        $this->products->destroy($products);
        return redirect()->route('admin.tradevillage.products.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::products.title.products')]));
    }
}
