<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\Documents;
use Modules\TradeVillage\Entities\Courses;
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
        $documents = $this->documents->all();
        $courses = DB::table('tradevillage__courses_translations')->get();
        return view('tradevillage::admin.documents.index', compact('documents', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $course = DB::table('tradevillage__courses_translations')->get();
        return view('tradevillage::admin.documents.create', compact('course'));
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
        $course = DB::table('tradevillage__courses')->pluck('id');
        return view('tradevillage::admin.documents.edit', compact('documents', 'course'));
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
