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
        $news = $this->news->all();
        return Response($news);
    }

    public function details(News $new)
    {
        return Response($new);
    }
}
