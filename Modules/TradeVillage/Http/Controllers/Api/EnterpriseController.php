<?php

namespace Modules\TradeVillage\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\Enterprises;
use Modules\TradeVillage\Entities\Village_fields;
use Modules\TradeVillage\Repositories\EnterprisesRepository;
use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\TradeVillage\Repositories\Village_fieldsRepository;
use Modules\Core\Http\Controllers\BasePublicController;

class EnterpriseController extends BasePublicController
{
    /**
     * @var ProductsRepository
     */
    private $enterprises;

    public function __construct(EnterprisesRepository $enterprises, Village_fieldsRepository $category, ProductsRepository $products )
    {
        parent::__construct();

        $this->enterprises = $enterprises;
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
        $enterprises = $this->enterprises->paginate($perPage = 16);
        // $categories = $this->category->all();
        return Response($enterprises->toJson());
    }

    public function details(Enterprises $enterprise)
    {
        $products = $this->products->getByAttributes(['enterprise_id' => $enterprise->id], $orderBy = 'created_at', $sortOrder = 'desc');
        return Response($products->toJson());
    }
}
