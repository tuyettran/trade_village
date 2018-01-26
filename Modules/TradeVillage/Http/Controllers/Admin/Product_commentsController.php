<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Product_comments;
use Modules\TradeVillage\Http\Requests\CreateProduct_commentsRequest;
use Modules\TradeVillage\Http\Requests\UpdateProduct_commentsRequest;
use Modules\TradeVillage\Repositories\Product_commentsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class Product_commentsController extends AdminBaseController
{
    /**
     * @var Product_commentsRepository
     */
    private $product_comments;

    public function __construct(Product_commentsRepository $product_comments)
    {
        parent::__construct();

        $this->product_comments = $product_comments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$product_comments = $this->product_comments->all();

        return view('tradevillage::admin.product_comments.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.product_comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProduct_commentsRequest $request
     * @return Response
     */
    public function store(CreateProduct_commentsRequest $request)
    {
        $this->product_comments->create($request->all());

        return redirect()->route('admin.tradevillage.product_comments.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::product_comments.title.product_comments')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product_comments $product_comments
     * @return Response
     */
    public function edit(Product_comments $product_comments)
    {
        return view('tradevillage::admin.product_comments.edit', compact('product_comments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Product_comments $product_comments
     * @param  UpdateProduct_commentsRequest $request
     * @return Response
     */
    public function update(Product_comments $product_comments, UpdateProduct_commentsRequest $request)
    {
        $this->product_comments->update($product_comments, $request->all());

        return redirect()->route('admin.tradevillage.product_comments.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::product_comments.title.product_comments')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product_comments $product_comments
     * @return Response
     */
    public function destroy(Product_comments $product_comments)
    {
        $this->product_comments->destroy($product_comments);

        return redirect()->route('admin.tradevillage.product_comments.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::product_comments.title.product_comments')]));
    }
}
