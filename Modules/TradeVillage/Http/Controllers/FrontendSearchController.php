<?php

namespace Modules\TradeVillage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Repositories\VillagesRepository;
use Modules\TradeVillage\Repositories\EnterprisesRepository;
use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\TradeVillage\Repositories\ArtistRepository;
use Modules\TradeVillage\Repositories\EventsRepository;
use Modules\TradeVillage\Repositories\NewsRepository;
use Modules\TradeVillage\Repositories\Village_fieldsRepository;
use Modules\Core\Http\Controllers\BasePublicController;

class FrontendSearchController extends BasePublicController
{
    private $villages;

    public function __construct(VillagesRepository $villages, ArtistRepository $artists, ProductsRepository $products, EnterprisesRepository $enterprises, EventsRepository $events, NewsRepository $news, Village_fieldsRepository $categories)
    {
        parent::__construct();

        $this->villages = $villages;
        $this->artists = $artists;
        $this->products = $products;
        $this->enterprises = $enterprises;
        $this->events = $events;
        $this->news = $news;
        $this->categories = $categories;
    }

    public function home(Request $request)
    {
        $key = trim($request->search);
        $artists = $this->artists->search($key, locale())->get();
        $villages = $this->villages->simple_search($key, locale())->get();
        $enterprises = $this->enterprises->search($key,locale())->get();
        $products = $this->products->simple_search($key, locale())->get();
        $events = $this->events->search($key, locale())->get();
        $news = $this->news->search($key, locale())->get();
        
        return view('tradevillage::frontend.villages.search_result', compact('key', 'artists', 'villages', 'enterprises', 'products', 'events', 'news'));
    }


    public function village(Request $request)
    {
        $key = trim($request->search);
        $category = $request->category;
        // $province = $request->province;
        $categories = $this->categories->all();
        // $villages = $this->villages->search($key, $category, $province, locale())->paginate(15);
        $villages = $this->villages->search($key, $category, locale())->paginate(15);
        return view('tradevillage::frontend.villages.village.search_result', compact('key', 'villages', 'categories', 'category'));
    }

    public function artist(Request $request)
    {
        $key = trim($request->search);
        $category = $request->category;
        $categories = $this->categories->all();
        if($category == 0){
            $artists = $this->artists->search($key, locale())->paginate(16);
            return view('tradevillage::frontend.villages.artists.search_result', compact('artists', 'categories', 'key'));
        }
        $village_ids = $this->villages->getByCategory($category);
        $category = $this->categories->find($category);
        $artists = $this->artists->searchArtistByVillages($village_ids, $key, locale())->paginate(16);
        
        return view('tradevillage::frontend.villages.artists.search_result', compact('key', 'artists', 'categories', 'category'));
    }

    public function event(Request $request)
    {
        $key = trim($request->search);
        $events = $this->events->search($key, locale())->paginate(16);
        
        return view('tradevillage::frontend.villages.events.search_result', compact('key', 'events'));
    }

    public function new(Request $request)
    {
        $key = trim($request->search);
        $news = $this->news->search($key, locale())->paginate(16);
        
        return view('tradevillage::frontend.villages.news.search_result', compact('key', 'news'));
    }

    public function enterprise(Request $request)
    {
        $categories = $this->categories->all();
        $category = $request->category;
        $key = trim($request->search);
        if($category == 0){
            $enterprises = $this->enterprises->search($key, locale())->paginate(16);
            return view('tradevillage::frontend.villages.enterprises.search_result', compact('key', 'enterprises', 'categories'));
        }
        $village_ids = $this->villages->getByCategory($category);
        $category = $this->categories->find($category);
        $enterprises = $this->enterprises->searchEnterpriseByVillages($village_ids, $key, locale())->paginate(16);
        
        return view('tradevillage::frontend.villages.enterprises.search_result', compact('key', 'enterprises', 'categories', 'category'));
    }

    public function enterprise_by_category(Request $request)
    {
        $categories = $this->categories->all();
        if($request->category == 0){
            $artists = $this->artists->paginate(16);
            return view('tradevillage::frontend.villages.artists.search_result', compact('artists', 'categories'));
        }
        $category = $this->categories->find($request->category);
        $village_ids = $this->villages->getByCategory($request->category);
        $enterprises = $this->enterprises->getEnterpriseByVillages($village_ids)->paginate(16);
        return view('tradevillage::frontend.villages.enterprises.search_result', compact('category', 'enterprises', 'categories'));
    }

    public function product(Request $request)
    {
        $key = trim($request->search);
        $categories = $this->categories->all();
        $category = $this->categories->find($request->category);
        $favorite = $request->favorite;
        $products = $this->products->search($key, locale(), $request->category, $favorite)->paginate(16);
        return view('tradevillage::frontend.villages.products.search_result', compact('key', 'products', 'categories', 'category', 'favorite'));
    }
}
