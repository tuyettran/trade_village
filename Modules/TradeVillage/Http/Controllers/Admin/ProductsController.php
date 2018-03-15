<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\TradeVillage\Entities\Products;
use Modules\TradeVillage\Http\Requests\CreateProductsRequest;
use Modules\TradeVillage\Http\Requests\UpdateProductsRequest;
use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ProductsController extends AdminBaseController
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
        $artists = DB::table('tradevillage__artist_translations')->get();
        $enterprises = DB::table('tradevillage__enterprises_translations')->get();
        return view('tradevillage::admin.products.index', compact('products', 'artists', 'enterprises'));
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
        $categories = DB::table('tradevillage__village_fields_translations')->get();
        return view('tradevillage::admin.products.create', compact('artists', 'enterprises', 'categories'));
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
        $requests['user_id'] = Auth::user()->id;
        $product = $this->products->create( $requests);
        $model_path = '/public/product/models/'.$product->id;
        $images_path = '/product/images/'.$product->id;
        if( !empty($request->file('file'))){
            foreach ($request->file('file') as $photo) {
                if(substr($photo->getMimeType(), 0, 5) == 'image') {
                    Storage::putFileAs($model_path, $photo, $photo->getClientOriginalName());
                }
            }

            $requests['model'] = $model_path; 
        } 
        if( !empty($request->file('image'))){
            foreach ($request->file('image') as $photo) {
                if(substr($photo->getMimeType(), 0, 5) == 'image') {
                    Storage::putFileAs('/public'.$images_path, $photo, $photo->getClientOriginalName());
                }
            }
            $requests['images'] = $images_path.'\\';  
            $this->products->update($product, $requests);;  
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
    public function edit(Products $products)
    {
        if(!empty($products->model)){
            $files = Storage::files($products->model);
        }
        if(!empty($products->images)){
            $images = Storage::files('/public'.$products->images);
        }
        $artists = DB::table('tradevillage__artist_translations')->get();
        $enterprises = DB::table('tradevillage__enterprises_translations')->get();
        $categories = DB::table('tradevillage__village_fields_translations')->get();
        return view('tradevillage::admin.products.edit', compact('products', 'artists', 'enterprises', 'files', 'images', 'categories'));
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
        $path = '/public/product/models/'.$products->id;
        $images_path = '/product/images/'.$products->id;
        if( !empty($request->delete_model)){
            if(!empty($products->model))
                Storage::deleteDirectory('/public'.$products->model);

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
        if( !empty($request->file('image'))){
            Storage::deleteDirectory('/public'.$products->images);
            foreach ($request->file('image') as $photo) {
                if(substr($photo->getMimeType(), 0, 5) == 'image') {
                    Storage::putFileAs('/public'.$images_path, $photo, $photo->getClientOriginalName());
                }
            }
            $requests['images'] = $images_path.'\\';
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
            Storage::deleteDirectory('/public'.$products->model);
        }
        if( !empty($products->images)){
            Storage::deleteDirectory('/public'.$products->images);
        }
        $this->products->destroy($products);
        return redirect()->route('admin.tradevillage.products.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::products.title.products')]));
    }
}
