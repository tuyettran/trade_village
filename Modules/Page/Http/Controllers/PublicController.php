<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Menu\Repositories\MenuItemRepository;
use Modules\Page\Entities\Page;
use Modules\Page\Repositories\PageRepository;
use Modules\TradeVillage\Entities\Artist;
use Modules\TradeVillage\Entities\Villages;
use Modules\TradeVillage\Entities\Products;
use Modules\TradeVillage\Entities\Enterprises;
use Modules\TradeVillage\Entities\News;
use Modules\TradeVillage\Entities\Events;
use Modules\TradeVillage\Repositories\ArtistRepository;
use Modules\TradeVillage\Repositories\ProductsRepository;
use Modules\TradeVillage\Repositories\VillagesRepository;
use Modules\TradeVillage\Repositories\NewsRepository;
use Modules\TradeVillage\Repositories\EventsRepository;
use Modules\TradeVillage\Repositories\EnterprisesRepository;
class PublicController extends BasePublicController
{
    /**
     * @var PageRepository
     */
    private $page;
    /**
     * @var Application
     */
    private $app;

    public function __construct(PageRepository $page, Application $app,VillagesRepository $villages, ProductsRepository $products, NewsRepository $news, EventsRepository $events, EnterprisesRepository $enterprises, ArtistRepository $artists)
    {
        parent::__construct();
        $this->page = $page;
        $this->app = $app;
        $this->villages = $villages;
        $this->products = $products;
        $this->events = $events;
        $this->news = $news;
        $this->enterprises = $enterprises;
        $this->artists = $artists;
    }

    /**
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function uri($slug)
    {
        $page = $this->findPageForSlug($slug);

        $this->throw404IfNotFound($page);

        $template = $this->getTemplateForPage($page);

        return view($template, compact('page'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function homepage()
    {
        $villages = $this->villages->findByMany([2,3]);
        $products = $this->products->favorite(8);
        $artists = $this->artists->findByMany([1,2]);
        $enterprises = $this->enterprises->all();
        $news = $this->news->all();
        $events = $this->events->newest_events(5);
        return view('tradevillage::frontend.villages.homepage', compact('villages', 'products', 'artists', 'enterprises', 'news', 'events'));;
    }

    /**
     * Find a page for the given slug.
     * The slug can be a 'composed' slug via the Menu
     * @param string $slug
     * @return Page
     */
    private function findPageForSlug($slug)
    {
        $menuItem = app(MenuItemRepository::class)->findByUriInLanguage($slug, locale());

        if ($menuItem) {
            return $this->page->find($menuItem->page_id);
        }

        return $this->page->findBySlug($slug);
    }

    /**
     * Return the template for the given page
     * or the default template if none found
     * @param $page
     * @return string
     */
    private function getTemplateForPage($page)
    {
        return (view()->exists($page->template)) ? $page->template : 'default';
    }

    /**
     * Throw a 404 error page if the given page is not found
     * @param $page
     */
    private function throw404IfNotFound($page)
    {
        if (is_null($page)) {
            $this->app->abort('404');
        }
    }
}
