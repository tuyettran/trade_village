<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $file = $request->file('file');
        $requests = $request->all();
        $documents = $this->documents->create($request->all());
        if( !empty($file)){
            if( $file->getClientOriginalExtension() == 'pdf'){
                Storage::disk('public')->putFileAs('/documents', $request->file('file'), $request->file('file')->getClientOriginalName());
                $requests['file'] = '/documents/'.$request->file('file')->getClientOriginalName(); 
            }
            else {
                $requests['file'] = '';
            }
            $documents->update($requests);  
        }
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
        $courses = DB::table('tradevillage__courses_translations')->get();
        return view('tradevillage::admin.documents.edit', compact('documents', 'courses'));
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
        $file = $request->file('file');
        $requests = $request->all();
        if( !empty($file)){
            if( $file->getClientOriginalExtension() == 'pdf'){
                Storage::disk('public')->delete($documents->file);
                Storage::disk('public')->putFileAs('/documents', $request->file('file'), $request->file('file')->getClientOriginalName());
                $requests['file'] = '/documents/'.$file->getClientOriginalName(); 
            }
            else {
                $requests['file'] = '';
            } 
        }
        $this->documents->update($documents, $requests);

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
        Storage::disk('public')->delete($documents->file);
        $this->documents->destroy($documents);

        return redirect()->route('admin.tradevillage.documents.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::documents.title.documents')]));
    }
}
