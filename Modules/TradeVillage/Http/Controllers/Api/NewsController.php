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
        // $villages = $this->villages->all();
        foreach ($news as $new) {
            $new['image'] = (string)($new->feature_image->path);
        }
        return response()->json($news); 
    }

    public function details(News $new)
    {
        $new['image'] = (string)($new->feature_image->path);
        return response($new);
    }
}
