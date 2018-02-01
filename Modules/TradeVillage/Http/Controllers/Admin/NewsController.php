<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\News;
use Modules\TradeVillage\Entities\VillagesTranslation;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Http\Requests\CreateNewsRequest;
use Modules\TradeVillage\Http\Requests\UpdateNewsRequest;
use Modules\TradeVillage\Repositories\NewsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class NewsController extends AdminBaseController
{
    /**
     * @var NewsRepository
     */
    private $news;

    public function __construct(NewsRepository $news)
    {
        parent::__construct();

        $this->news = $news;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $news = $this->news->all();
        $villages = DB::table('tradevillage__villages_translations')->get();

        return view('tradevillage::admin.news.index', compact('news', 'villages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $villages = DB::table('tradevillage__villages_translations')->get();
        return view('tradevillage::admin.news.create', compact('villages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateNewsRequest $request
     * @return Response
     */
    public function store(CreateNewsRequest $request)
    {
        $this->news->create($request->all());

        return redirect()->route('admin.tradevillage.news.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::news.title.news')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  News $news
     * @return Response
     */
    public function edit(News $news)
    {
        $villages = DB::table('tradevillage__villages_translations')->get();
        return view('tradevillage::admin.news.edit', compact('news', 'villages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  News $news
     * @param  UpdateNewsRequest $request
     * @return Response
     */
    public function update(News $news, UpdateNewsRequest $request)
    {
        $this->news->update($news, $request->all());

        return redirect()->route('admin.tradevillage.news.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::news.title.news')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  News $news
     * @return Response
     */
    public function destroy(News $news)
    {
        $this->news->destroy($news);

        return redirect()->route('admin.tradevillage.news.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::news.title.news')]));
    }
}
