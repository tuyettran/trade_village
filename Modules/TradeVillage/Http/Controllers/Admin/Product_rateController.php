<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\Product_rate;
use Modules\TradeVillage\Entities\Products;
use Modules\User\Entities\Sentinel\User;
use Modules\TradeVillage\Http\Requests\CreateProduct_rateRequest;
use Modules\TradeVillage\Http\Requests\UpdateProduct_rateRequest;
use Modules\TradeVillage\Repositories\Product_rateRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class Product_rateController extends AdminBaseController
{
    /**
     * @var Product_rateRepository
     */
    private $product_rate;

    public function __construct(Product_rateRepository $product_rate)
    {
        parent::__construct();

        $this->product_rate = $product_rate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $product_rates = $this->product_rate->all();
        $products = DB::table('tradevillage__products_translations')->get();
        $users = DB::table('users')->select('id','last_name', 'first_name')->get();
        return view('tradevillage::admin.product_rates.index', compact('product_rates', 'products', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $products = DB::table('tradevillage__products_translations')->get();
        $users = DB::table('users')->get();
        return view('tradevillage::admin.product_rates.create', compact('products', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProduct_rateRequest $request
     * @return Response
     */
    public function store(CreateProduct_rateRequest $request)
    {
        $this->product_rate->create($request->all());

        return redirect()->route('admin.tradevillage.product_rate.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::product_rates.title.product_rates')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product_rate $product_rate
     * @return Response
     */
    public function edit(Product_rate $product_rate)
    {
        $products = DB::table('tradevillage__products_translations')->get();
        $users = DB::table('users')->get();
        return view('tradevillage::admin.product_rates.edit', compact('product_rate', 'products', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Product_rate $product_rate
     * @param  UpdateProduct_rateRequest $request
     * @return Response
     */
    public function update(Product_rate $product_rate, UpdateProduct_rateRequest $request)
    {
        $this->product_rate->update($product_rate, $request->all());

        return redirect()->route('admin.tradevillage.product_rate.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::product_rates.title.product_rates')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product_rate $product_rate
     * @return Response
     */
    public function destroy(Product_rate $product_rate)
    {
        $this->product_rate->destroy($product_rate);

        return redirect()->route('admin.tradevillage.product_rate.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::product_rates.title.product_rates')]));
    }
}
