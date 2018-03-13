<?php

namespace Modules\TradeVillage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Modules\TradeVillage\Entities\Products;
use Modules\TradeVillage\Entities\Village_fields;
use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\TradeVillage\Repositories\Village_fieldsRepository;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\User\Repositories\UserRespository;

class FrontendVillageFieldController extends BasePublicController
{
    /**
     * @var ProductsRepository
     */
    private $products;

    public function __construct(ProductsRepository $products, Village_fieldsRepository $category)
    {
        parent::__construct();

        $this->products = $products;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function product(Village_fields $category)
    {
        $products = $this->products->getByAttributes(['category_id' => $category->id])->paginate($perPage = 15);
        print_r($products);
        // return view('tradevillage::frontend.villages.village_fields.products', compact('products', 'category'));
    }
}
