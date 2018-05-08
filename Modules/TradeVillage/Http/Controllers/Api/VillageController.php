<?php

namespace Modules\TradeVillage\Http\Controllers\Api;

use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Villages;
use Modules\TradeVillage\Entities\Village_fields;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\TradeVillage\Repositories\Village_fieldsRepository;
use Modules\TradeVillage\Repositories\VillagesRepository;
use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\TradeVillage\Repositories\NewsRepository;
use Modules\TradeVillage\Repositories\EventsRepository;
use Modules\TradeVillage\Repositories\ArtistRepository;
use Modules\TradeVillage\Repositories\EnterprisesRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class VillageController extends BasePublicController
{
    /**
     * @var ProductsRepository
     */
    private $categories;
    private $villages;
    private $news;

    public function __construct(NewsRepository $news, Village_fieldsRepository $categories, VillagesRepository $villages, EnterprisesRepository $enterprises, ProductsRepository $products, ArtistRepository $artists, EventsRepository $events)
    {
        parent::__construct();
        $this->categories = $categories;
        $this->villages = $villages;
        $this->news = $news;
        $this->events = $events;
        $this->enterprises = $enterprises;
        $this->products = $products;
        $this->artists = $artists;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function list()
    {
        $villages = $this->villages->all();
        foreach ($villages as $village) {
            $village['image'] = (string)($village->image_village->path);
        }
        return response()->json($villages); 
    }   
}