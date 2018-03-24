<?php

namespace Modules\TradeVillage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Villages;
use Modules\TradeVillage\Entities\Village_fields;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\TradeVillage\Repositories\Village_fieldsRepository;
use Modules\TradeVillage\Repositories\VillagesRepository;
use Modules\TradeVillage\Repositories\NewsRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class FrontendVillagesController extends BasePublicController
{
    /**
     * @var ProductsRepository
     */
    private $categories;
    private $villages;
    private $news;

    public function __construct(NewsRepository $news, Village_fieldsRepository $categories, VillagesRepository $villages)
    {
        parent::__construct();
        $this->categories = $categories;
        $this->villages = $villages;
        $this->news = $news;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->categories->all();
        return view('tradevillage::frontend.villages.village.index', compact('categories'));
    }

    public function show(Villages $village)
    {   
        $collecTopPros = collect();
        $news = $village->news;
        $latestNews = $this->news->latestNews($village->id, 5);
        $events = $village->events;
        
        $enterprises = $village->enterprises;
        if(count($enterprises) > 0) {
            foreach ($enterprises as $enterprise) {
                $products = $enterprise->products;
                if(count($products) > 0) {
                    foreach ($products as $product) {
                        $avgRate = 0;
                        if(count($product->rates) > 0) {
                            $rat = 0;
                            foreach ($product->rates as $rate) {
                                $rat += $rate->value;
                            }
                            $avgRate = $rat/count($product->rates);
                        }
                        $collecTopPros->push(['product'=>$product, 'rate'=>$avgRate]);
                    }
                }
            }
        }

        $artists = $village->artists;
        if(count($artists) > 0) {
            foreach ($artists as $artist) {
                $products = $artist->products;
                if(count($products) > 0) {
                    foreach ($products as $product) {
                        $avgRate = 0;
                        if(count($product->rates) > 0) {
                            $rat = 0;
                            foreach ($product->rates as $rate) {
                                $rat += $rate->value;
                            }
                            $avgRate = $rat/count($product->rates);
                        }
                        $collecTopPros->push(['product'=>$product, 'rate'=>$avgRate]);
                    }
                }
            }
        }
        $collectAll = $collecTopPros->sortByDesc('rate');
        $collecTopPros = $collecTopPros->sortByDesc('rate');
        while($collecTopPros->count() > 7) {
            $collecTopPros->pop();
        }
        
        return view('tradevillage::frontend.villages.village.show', compact('village', 'collecTopPros', 'collectAll', 'enterprises', 'artists', 'news', 'events', 'latestNews'));
    }

    public function xmlGenerate(Villages $village) {
        $enterprises = $village->enterprises;
        return $enterprises;
    }
}
