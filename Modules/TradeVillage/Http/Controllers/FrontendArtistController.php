<?php

namespace Modules\TradeVillage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\Artist;
use Modules\TradeVillage\Entities\Village_fields;
use Modules\TradeVillage\Repositories\ArtistRepository;
use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\TradeVillage\Repositories\Village_fieldsRepository;
use Modules\Core\Http\Controllers\BasePublicController;

class FrontendArtistController extends BasePublicController
{
    /**
     * @var ProductsRepository
     */
    private $artist;

    public function __construct(ArtistRepository $artist, Village_fieldsRepository $category, ProductsRepository $products )
    {
        parent::__construct();

        $this->artist = $artist;
        $this->category = $category;
        $this->products = $products;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $artists = $this->artist->paginate($perPage = 16);
        $categories = $this->category->all();
        return view('tradevillage::frontend.villages.artists.index', compact('artists', 'categories'));
    }

    public function show(Artist $artist)
    {
        $products = $this->products->getByAttributes(['artist_id' => $artist->id], $orderBy = 'created_at', $sortOrder = 'desc');
        return view('tradevillage::frontend.villages.artists.show', compact('artist', 'products'));
    }
}
