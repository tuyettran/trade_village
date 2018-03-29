<?php

namespace Modules\TradeVillage\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\News;
use Modules\TradeVillage\Repositories\NewsRepository;
use Modules\Core\Http\Controllers\BasePublicController;

class NewsController extends BasePublicController
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
    public function list()
    {
        $news = $this->news->paginate($perPage = 10);
        $newests = $this->news->newest(6);
        return Response($news->toJson());
    }

    public function details(News $new)
    {
        $newests = $this->news->newest(5);
        $relatedNews = $this->news->latestNews($new->village_id, 3);
        return Response($newests->toJson());
    }
}
