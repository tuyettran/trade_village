<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Links;
use Modules\TradeVillage\Entities\VillagesTranslation;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Http\Requests\CreateLinksRequest;
use Modules\TradeVillage\Http\Requests\UpdateLinksRequest;
use Modules\TradeVillage\Repositories\LinksRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class LinksController extends AdminBaseController
{
    /**
     * @var LinksRepository
     */
    private $links;

    public function __construct(LinksRepository $links)
    {
        parent::__construct();

        $this->links = $links;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $links = $this->links->all();
        $villages = DB::table('tradevillage__villages_translations')->get();

        return view('tradevillage::admin.links.index', compact('villages', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $villages = DB::table('tradevillage__villages_translations')->get();
        return view('tradevillage::admin.links.create', compact('villages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLinksRequest $request
     * @return Response
     */
    public function store(CreateLinksRequest $request)
    {
        $this->links->create($request->all());

        return redirect()->route('admin.tradevillage.links.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::links.title.links')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Links $links
     * @return Response
     */
    public function edit(Links $links)
    {
        $villages = DB::table('tradevillage__villages_translations')->get();
        return view('tradevillage::admin.links.edit', compact('links', 'villages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Links $links
     * @param  UpdateLinksRequest $request
     * @return Response
     */
    public function update(Links $links, UpdateLinksRequest $request)
    {
        $this->links->update($links, $request->all());

        return redirect()->route('admin.tradevillage.links.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::links.title.links')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Links $links
     * @return Response
     */
    public function destroy(Links $links)
    {
        $this->links->destroy($links);

        return redirect()->route('admin.tradevillage.links.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::links.title.links')]));
    }
}
