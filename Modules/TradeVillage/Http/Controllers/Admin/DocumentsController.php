<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Documents;
use Modules\TradeVillage\Http\Requests\CreateDocumentsRequest;
use Modules\TradeVillage\Http\Requests\UpdateDocumentsRequest;
use Modules\TradeVillage\Repositories\DocumentsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class DocumentsController extends AdminBaseController
{
    /**
     * @var DocumentsRepository
     */
    private $documents;

    public function __construct(DocumentsRepository $documents)
    {
        parent::__construct();

        $this->documents = $documents;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$documents = $this->documents->all();

        return view('tradevillage::admin.documents.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateDocumentsRequest $request
     * @return Response
     */
    public function store(CreateDocumentsRequest $request)
    {
        $this->documents->create($request->all());

        return redirect()->route('admin.tradevillage.documents.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::documents.title.documents')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Documents $documents
     * @return Response
     */
    public function edit(Documents $documents)
    {
        return view('tradevillage::admin.documents.edit', compact('documents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Documents $documents
     * @param  UpdateDocumentsRequest $request
     * @return Response
     */
    public function update(Documents $documents, UpdateDocumentsRequest $request)
    {
        $this->documents->update($documents, $request->all());

        return redirect()->route('admin.tradevillage.documents.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::documents.title.documents')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Documents $documents
     * @return Response
     */
    public function destroy(Documents $documents)
    {
        $this->documents->destroy($documents);

        return redirect()->route('admin.tradevillage.documents.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::documents.title.documents')]));
    }
}
