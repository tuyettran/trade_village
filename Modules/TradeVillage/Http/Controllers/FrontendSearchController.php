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
        $artists = $this->artists->search($key,'vi')->get();
        $villages = $this->villages->search($key,'vi')->get();
        $enterprises = $this->enterprises->search($key,'vi')->get();
        $products = $this->products->search($key, 'vi')->get();
        $events = $this->events->search($key, 'vi')->get();
        $news = $this->news->search($key, 'vi')->get();
        
        return view('tradevillage::frontend.villages.search_result', compact('key', 'artists', 'villages', 'enterprises', 'products', 'events', 'news'));
    }

    public function artist(Request $request)
    {
        $key = trim($request->search);
        $artists = $this->artists->search($key,'vi')->paginate(16);
        
        return view('tradevillage::frontend.villages.artists.search_result', compact('key', 'artists'));
    }

    public function event(Request $request)
    {
        $key = trim($request->search);
        $events = $this->events->search($key,'vi')->paginate(16);
        
        return view('tradevillage::frontend.villages.events.search_result', compact('key', 'events'));
    }

    public function new(Request $request)
    {
        $key = trim($request->search);
        $news = $this->news->search($key,'vi')->paginate(16);
        
        return view('tradevillage::frontend.villages.news.search_result', compact('key', 'news'));
    }

    public function enterprise(Request $request)
    {
        $key = trim($request->search);
        $enterprises = $this->enterprises->search($key,'vi')->paginate(16);
        
        return view('tradevillage::frontend.villages.enterprises.search_result', compact('key', 'enterprises'));
    }

    public function enterprise_by_category(Request $request)
    {
        $category = $this->categories->find($request->category);
        $village_ids = $this->villages->getByCategory($request->category);
        $enterprises = $this->enterprises->getEnterpriseByVillages($village_ids)->paginate(16);
        return view('tradevillage::frontend.villages.enterprises.search_result', compact('category', 'enterprises'));
    }

    public function product(Request $request)
    {
        $key = trim($request->search);
        $categories = $this->categories->all();
        $products = $this->products->search($key,'vi')->paginate(16);
        
        return view('tradevillage::frontend.villages.products.search_result', compact('key', 'products', 'categories'));
    }
}
