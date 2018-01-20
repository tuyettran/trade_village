<?php

namespace Modules\TradeVillage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TradeVillage\Entities\Artist;
use Modules\TradeVillage\Http\Requests\CreateArtistRequest;
use Modules\TradeVillage\Http\Requests\UpdateArtistRequest;
use Modules\TradeVillage\Repositories\ArtistRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ArtistController extends AdminBaseController
{
    /**
     * @var ArtistRepository
     */
    private $artist;

    public function __construct(ArtistRepository $artist)
    {
        parent::__construct();

        $this->artist = $artist;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$artists = $this->artist->all();

        return view('tradevillage::admin.artists.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tradevillage::admin.artists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateArtistRequest $request
     * @return Response
     */
    public function store(CreateArtistRequest $request)
    {
        $this->artist->create($request->all());

        return redirect()->route('admin.tradevillage.artist.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tradevillage::artists.title.artists')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Artist $artist
     * @return Response
     */
    public function edit(Artist $artist)
    {
        return view('tradevillage::admin.artists.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Artist $artist
     * @param  UpdateArtistRequest $request
     * @return Response
     */
    public function update(Artist $artist, UpdateArtistRequest $request)
    {
        $this->artist->update($artist, $request->all());

        return redirect()->route('admin.tradevillage.artist.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tradevillage::artists.title.artists')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Artist $artist
     * @return Response
     */
    public function destroy(Artist $artist)
    {
        $this->artist->destroy($artist);

        return redirect()->route('admin.tradevillage.artist.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tradevillage::artists.title.artists')]));
    }
}
