<?php

namespace Modules\TradeVillage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Repositories\VillagesRepository;
use Modules\TradeVillage\Repositories\EnterprisesRepository;
use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\TradeVillage\Repositories\ArtistRepository;
use Modules\Core\Http\Controllers\BasePublicController;

class FrontendSearchController extends BasePublicController
{
    private $villages;

    public function __construct(VillagesRepository $villages, ArtistRepository $artists, ProductsRepository $products, EnterprisesRepository $enterprises)
    {
        parent::__construct();

        $this->villages = $villages;
        $this->artists = $artists;
        $this->products = $products;
        $this->enterprises = $enterprises;
    }

    public function home(Request $request)
    {
        $key = mb_strtolower(trim($request->search), 'utf-8');
        $artists = $this->artists->search($key,'vi');
        $villages = $this->villages->search($key,'vi');
        $enterprises = $this->enterprises->search($key,'vi');
        $products = $this->products->search($key, 'vi');
        
        return view('tradevillage::frontend.villages.search_result', compact('key', 'artists', 'villages', 'enterprises', 'products'));
    }
}
