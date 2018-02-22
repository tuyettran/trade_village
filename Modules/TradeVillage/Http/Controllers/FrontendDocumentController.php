<?php

namespace Modules\TradeVillage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\Documents;
use Modules\TradeVillage\Http\Requests\CreateDocumentsRequest;
use Modules\TradeVillage\Http\Requests\UpdateDocumentsRequest;
use Modules\TradeVillage\Repositories\DocumentsRepository;
use Modules\Core\Http\Controllers\BasePublicController;

class FrontendDocumentController extends BasePublicController
{
    private $document;

    public function __construct(DocumentsRepository $document)
    {
        parent::__construct();

        $this->document = $document;
    }

    public function index()
    {
        $documents = $this->document->all();
        return view('tradevillage::frontend.education.documents.index', compact('documents', 'villages'));
    }
}
