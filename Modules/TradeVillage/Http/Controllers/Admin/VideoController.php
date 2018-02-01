<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TradeVillage\Entities\Video;
use Modules\TradeVillage\Entities\Courses;
use Modules\TradeVillage\Http\Requests\CreateVideoRequest;
use Modules\TradeVillage\Http\Requests\UpdateVideoRequest;
use Modules\TradeVillage\Repositories\VideoRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class VideoController extends AdminBaseController
{
    /**
     * @var VideoRepository
     */
    private $video;

    public function __construct(VideoRepository $video)
    {
        parent::__construct();

        $this->video = $video;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $videos = $this->video->all();
        $courses = DB::table('tradevillage__courses_translations')->get();
        return view('tradevillage::admin.videos.index', compact('videos','courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $courses = DB::table('tradevillage__courses_translations')->get();
        return view('tradevillage::admin.videos.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateVideoRequest $request
     * @return Response
     */
    public function store(CreateVideoRequest $request)
    {
        $this->video->create($request->all());
        return redirect()->route('admin.tradevillage.video.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::videos.title.videos')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Video $video
     * @return Response
     */
    public function edit(Video $video)
    {
        $courses = DB::table('tradevillage__courses_translations')->get();
        return view('tradevillage::admin.videos.edit', compact('video','courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Video $video
     * @param  UpdateVideoRequest $request
     * @return Response
     */
    public function update(Video $video, UpdateVideoRequest $request)
    {
        $this->video->update($video, $request->all());

        return redirect()->route('admin.tradevillage.video.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::videos.title.videos')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Video $video
     * @return Response
     */
    public function destroy(Video $video)
    {
        $this->video->destroy($video);

        return redirect()->route('admin.tradevillage.video.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::videos.title.videos')]));
    }
}
