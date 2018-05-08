<?php

namespace Modules\TradeVillage\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\Artist;
use Modules\TradeVillage\Entities\Village_fields;
use Modules\TradeVillage\Repositories\ArtistRepository;
use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\TradeVillage\Repositories\Village_fieldsRepository;
use Modules\Core\Http\Controllers\BasePublicController;

class ArtistController extends BasePublicController
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
    public function list()
    {
        $artists = $this->artist->all();
        foreach ($artists as $artist) {
            $artist['image'] = (string)($artist->feature_image->path);
        }
        return response()->json($artists); 
    }

    public function details(Artist $artist)
    {
        // $artist['description'] = (string)($artist->feature_image->path);
        return response($artist);
    }
}
