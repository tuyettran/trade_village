<?php

namespace Modules\TradeVillage\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Modules\TradeVillage\Entities\Products;
use Modules\TradeVillage\Entities\Village_fields;
use Modules\TradeVillage\Repositories\EnterprisesRepository;
use Modules\TradeVillage\Repositories\ArtistRepository;
use Modules\TradeVillage\Http\Requests\CreateProductsRequest;
use Modules\TradeVillage\Http\Requests\UpdateProductsRequest;
use Modules\TradeVillage\Http\Requests\UpdateProduct_rateRequest;
use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\TradeVillage\Repositories\Village_fieldsRepository;
use Modules\TradeVillage\Repositories\Product_rateRepository;
use Modules\Core\Http\Controllers\BasePublicController;
class ProductController extends BasePublicController
{
    /**
     * @var ProductsRepository
     */
    private $products;

    public function __construct(ProductsRepository $products, Village_fieldsRepository $category, ArtistRepository $artist, EnterprisesRepository $enterprise, Product_rateRepository $rates)
    {
        parent::__construct();

        $this->products = $products;
        $this->category = $category;
        $this->artist = $artist;
        $this->enterprise = $enterprise;
        $this->rates = $rates;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function list()
    {
        $products = $this->products->all();
        foreach ($products as $product) {
            $product['image'] = substr(Storage::files('/public/product/images/'.$product->id)[0],7);
        }
        return response()->json($products); 
    }   
}
