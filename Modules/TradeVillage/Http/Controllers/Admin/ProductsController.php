<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        //$products = $this->products->all();

        return view('tradevillage::admin.products.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductsRequest $request
     * @return Response
     */
    public function store(CreateProductsRequest $request)
    {
        $this->products->create($request->all());

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
        return view('tradevillage::admin.products.edit', compact('products'));
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
        $this->products->update($products, $request->all());

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
        $this->products->destroy($products);

        return redirect()->route('admin.tradevillage.products.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::products.title.products')]));
    }
}
