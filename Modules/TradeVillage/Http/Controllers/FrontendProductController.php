<?php

namespace Modules\TradeVillage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\TradeVillage\Entities\Products;
use Modules\TradeVillage\Entities\Village_fields;
use Modules\TradeVillage\Repositories\EnterprisesRepository;
use Modules\TradeVillage\Repositories\ArtistRepository;
use Modules\TradeVillage\Http\Requests\CreateProductsRequest;
use Modules\TradeVillage\Http\Requests\UpdateProductsRequest;
use Modules\TradeVillage\Http\Requests\UpdateProduct_rateRequest;
use Modules\TradeVillage\Http\Requests\CreateProduct_commentsRequest;
use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\TradeVillage\Repositories\Village_fieldsRepository;
use Modules\TradeVillage\Repositories\Product_rateRepository;
use Modules\TradeVillage\Repositories\Product_commentsRepository;
use Modules\Core\Http\Controllers\BasePublicController;
class FrontendProductController extends BasePublicController
{
    /**
     * @var ProductsRepository
     */
    private $products;

    public function __construct(ProductsRepository $products, Village_fieldsRepository $category, ArtistRepository $artist, EnterprisesRepository $enterprise, Product_rateRepository $rates, Product_commentsRepository $comment)
    {
        parent::__construct();

        $this->products = $products;
        $this->category = $category;
        $this->artist = $artist;
        $this->enterprise = $enterprise;
        $this->rates = $rates;
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->category->all();
        $newest_products = $this->products->newest(4);
        $favorite = $this->products->favorite(4);
        $hot = $this->products->hot(4);
        return view('tradevillage::frontend.villages.products.index', compact('categories', 'newest_products', 'favorite', 'hot'));
    }   

    public function show(Products $product)
    {
        $categories = $this->category->all();
        $images = Storage::files('/public/product/images/'.$product->id);
        $comments = $product->comments()->orderBy('updated_at','DESC')->paginate(10);
        if(Auth::user()){
            $user = Auth::user();
            $rates = $this->rates->findByAttributes(['user_id' => $user->id, 'product_id' => $product->id]);
            if($rates)
                $rate = $rates->value;
            else
                $rate = 0;
        }
        else{
            $rate = round($product->rate);
        }
        return view('tradevillage::frontend.villages.products.show', compact('categories', 'product', 'images', 'comments', 'rate'));
    }

    public function user_products($user_id)
    {
        $products = $this->products->getAllByAttributes(['user_id' => $user_id])->paginate(20);
        $categories = $this->category->all();
        $newest_products = $this->products->newest(4);
        $favorite = $this->products->favorite(4);
        $hot = $this->products->hot(4);
        return view('tradevillage::frontend.villages.products.index', compact('products', 'categories', 'user_id', 'newest_products', 'favorite', 'hot'));
    }

    public function category_products($category_id)
    {
        $products = $this->products->getAllByAttributes(['category_id' => $category_id])->paginate(20);
        $categories = $this->category->all();
        $newest_products = $this->products->newest(4);
        $favorite = $this->products->favorite(4);
        $hot = $this->products->hot(4);
        $category = $this->category->find($category_id);
        return view('tradevillage::frontend.villages.products.category_products', compact('products', 'categories', 'category', 'newest_products', 'favorite', 'hot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = DB::table('tradevillage__village_fields_translations')->get();
        return view('tradevillage::frontend.villages.products.create', compact('categories'));
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
        if($this->artist->findByAttributes(['user_id' => $requests['user_id']]))
            $requests['artist_id'] = $this->artist->findByAttributes(['user_id' => $requests['user_id']])->id;
        if($this->enterprise->findByAttributes(['user_id' => $requests['user_id']]))
            $requests['enterprise_id'] = $this->enterprise->findByAttributes(['user_id' => $requests['user_id']])->id;
        $product = $this->products->create( $requests);
        $path = '/public/product/models/'.$product->id;
        $images_path = '/product/images/'.$product->id;
        if( !empty($request->file('file'))){
            foreach ($request->file('file') as $photo) {
                if(substr($photo->getMimeType(), 0, 5) == 'image') {
                    Storage::putFileAs($path, $photo, $photo->getClientOriginalName());  
                }
            }
            $requests['model'] = $path;
        }
        if( !empty($request->file('image'))){
            foreach ($request->file('image') as $photo) {
                if(substr($photo->getMimeType(), 0, 5) == 'image') {
                    Storage::putFileAs('/public'.$images_path, $photo, $photo->getClientOriginalName());
                }
            }
            $requests['images'] = $images_path.'/';
        }
        $product->update($requests);
        return redirect()->route('frontend.tradevillage.products.index')
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
        if (Gate::denies('update-product', $product)) {
            abort(403);
        }

        if(!empty($product->model)){
            $files = Storage::files($product->model);
        }
        if(!empty($product->images)){
            $images = Storage::files('/public'.$product->images);
        }
        $categories = DB::table('tradevillage__village_fields_translations')->get();
        return view('tradevillage::frontend.villages.products.edit', compact('product', 'files', 'images', 'categories'));
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
        if (Gate::denies('update-product', $products)) {
            abort(403);
        }
        $requests = $request->all();
        $path = '/public/product/models/'.$products->id;
        $images_path = '/product/images/'.$products->id;
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
        if( !empty($request->file('image'))){
            if(!empty($products->images)){
                Storage::deleteDirectory($products->images);
            }
            foreach ($request->file('image') as $photo) {
                if(substr($photo->getMimeType(), 0, 5) == 'image') {
                    Storage::putFileAs('/public'.$images_path, $photo, $photo->getClientOriginalName());
                }
            }
            $requests['images'] = $images_path.'/';
        }
        $this->products->update($products, $requests);
        return redirect()->route('frontend.tradevillage.products.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::products.title.products')]));
    }

    public function model(Products $product)
    {
        return view('tradevillage::frontend.villages.products.product_model', compact('product'));
    }

    public function rate(Products $product, UpdateProduct_rateRequest $request)
    {
        $user_id = Auth::user()->id;
        $rate = $this->rates->findByAttributes(['user_id' => $user_id, 'product_id' => $product->id]);

        $requests = $request->all();
        $rates_number = count($product->rates);
        if($rate){
            $rate_total = ($product->rate*$rates_number) + $request->value - $rate->value;
            $product_rate_update = $rate_total/$rates_number;
            $attribute = ['rate' => $product_rate_update];
            $this->rates->update($rate, $requests);
        }
        else {
            $rate_total = ($product->rate*$rates_number) + $request->value;
            $rates_number +=1;
            $product_rate_update = $rate_total/$rates_number;
            $attribute = ['rate' => $product_rate_update];
            $requests['product_id'] = $product->id;
            $requests['user_id'] = $user_id;
            $this->rates->create($requests);
        }

        $product->update($attribute);
        $response = ['rate_avg' => round($product->rate,1), 'rates_number' => $rates_number];
        return Response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Products $products
     * @return Response
     */
    public function destroy(Products $products)
    {
        if (Gate::denies('update-product', $products)) {
            abort(403);
        }
        if( !empty($products->model)){
            Storage::deleteDirectory($products->model);
        }
        if( !empty($products->images)){
            Storage::deleteDirectory('/public'.$products->images);
        }
        $this->products->destroy($products);
        return redirect()->route('frontend.tradevillage.products.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::products.title.products')]));
    }

    //Comment System Controller
    //Create a comment
    public function comment(Products $product, CreateProduct_commentsRequest $request)
    {
        $requests = $request->all();
        $requests['user_id'] = Auth::user()->id;
        $requests['product_id'] = $product->id;

        $comment = $this->comment->create($requests);
        return $comment->toJson();
    }

    //Delete a comment
    public function deleteComment(Request $request)
    {
        $comment = $this->comment->find($request['id']);
        $delComment = $this->comment->destroy($comment);
        return json_encode($delComment);
    }
}
