<?php

namespace Modules\TradeVillage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\News;
use Modules\TradeVillage\Repositories\NewsRepository;
use Modules\Core\Http\Controllers\BasePublicController;

class FrontendNewsController extends BasePublicController
{
    /**
     * @var ProductsRepository
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
        $news = $this->news->paginate($perPage = 10);
        $newests = $this->news->newest(6);
        return view('tradevillage::frontend.villages.news.index', compact('news', 'newests'));
    }

    public function show(News $new)
    {
        $newests = $this->news->newest(5);
        $relatedNews = $this->news->latestNews($new->village_id, 3);
        return view('tradevillage::frontend.villages.news.show', compact('new', 'newests', 'relatedNews'));
    }
}
