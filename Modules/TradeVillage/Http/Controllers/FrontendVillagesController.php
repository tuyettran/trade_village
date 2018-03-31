<?php

namespace Modules\TradeVillage\Http\Controllers;

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

class FrontendVillagesController extends BasePublicController
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

//get all enterprises in village
    public function enterprises(Villages $village) {
        if($village->enterprises){
            $enterprises = $this->enterprises->getEnterpriseByAttributes(['village_id' => $village->id])->paginate($perPage = 20);
            return view('tradevillage::frontend.villages.enterprises.index', compact('enterprises', 'village'));
        }
        else
            return view('tradevillage::frontend.villages.enterprises.index', compact('village'));
    }

//get products of all artists and enterprises in village
    public function products(Villages $village) {
        $enterprises = array();
        $artists = array();
        foreach ($village->enterprises as $enterprise) {
            $enterprises[] = $enterprise->id;
        }
        foreach ($village->artists as $artist) {
            $artists[] = $artist->id;
        }
        $products = $this->products->getAllByVillage($enterprises, $artists)->paginate(20);
        $newest_products = $this->products->newest(4);
        $favorite = $this->products->favorite(4);
        $hot = $this->products->hot(4);
        return view('tradevillage::frontend.villages.products.index', compact('newest_products', 'favorite', 'hot', 'products', 'village'));
    }

// get all artists of village
    public function artists(Villages $village) {
        $artists = $this->artists->getArtistByAttributes(['village_id' => $village->id])->paginate(20);
        return view('tradevillage::frontend.villages.artists.index', compact('artists','village'));
    }

    public function news(Villages $village) {
        if($village->news){
            $news = $this->news->getNewsByAttributes(['village_id' => $village->id])->paginate(20);
        }
        return view('tradevillage::frontend.villages.news.index', compact('village', 'news'));
    }

    public function events(Villages $village) {
        if($village->events){
            $events = $this->events->getEventsByAttributes(['village_id' => $village->id])->paginate(20);
        }
        return view('tradevillage::frontend.villages.events.index', compact('village', 'events'));
    }
    
    //get all of villages
    public function getAllVillages() {
        $villages = $this->villages->all();
        return $villages;
    }
}
