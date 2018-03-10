<?php

namespace Modules\TradeVillage\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterTradeVillageSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('tradevillage::trade_villages.title.trade_villages'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('tradevillage::villages.title.villages'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.villages.create');
                    $item->route('admin.tradevillage.villages.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.villages.index')
                    );
                });
                $item->item(trans('tradevillage::enterprises.title.enterprises'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.enterprises.create');
                    $item->route('admin.tradevillage.enterprises.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.enterprises.index')
                    );
                });
                $item->item(trans('tradevillage::news.title.news'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.news.create');
                    $item->route('admin.tradevillage.news.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.news.index')
                    );
                });

                $item->item(trans('tradevillage::links.title.links'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.links.create');
                    $item->route('admin.tradevillage.links.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.links.index')
                    );
                });
                
                $item->item(trans('tradevillage::products.title.products'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.products.create');
                    $item->route('admin.tradevillage.products.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.products.index')
                    );
                });
                $item->item(trans('tradevillage::village_fields.title.village_fields'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.village_fields.create');
                    $item->route('admin.tradevillage.village_fields.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.village_fields.index')
                    );
                });

                $item->item(trans('tradevillage::product_comments.title.product_comments'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->route('admin.tradevillage.product_comments.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.product_comments.index')
                    );
                });

                $item->item(trans('tradevillage::processes.title.processes'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.process.create');
                    $item->route('admin.tradevillage.process.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.processes.index')
                    );
                });

                $item->item(trans('tradevillage::product_rates.title.product_rates'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->route('admin.tradevillage.product_rate.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.product_rates.index')
                    );
                });

                $item->item(trans('tradevillage::events.title.events'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.events.create');
                    $item->route('admin.tradevillage.events.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.events.index')
                    );
                });
                $item->item(trans('tradevillage::artists.title.artists'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.artist.create');
                    $item->route('admin.tradevillage.artist.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.artists.index')
                    );
                });
                
                // $item->item(trans('tradevillage::provinces.title.provinces'), function (Item $item) {
                //     $item->icon('fa fa-copy');
                //     $item->weight(0);
                //     $item->append('admin.tradevillage.provinces.create');
                //     $item->route('admin.tradevillage.provinces.index');
                //     $item->authorize(
                //         $this->auth->hasAccess('tradevillage.provinces.index')
                //     );
                // });
                // $item->item(trans('tradevillage::districts.title.districts'), function (Item $item) {
                //     $item->icon('fa fa-copy');
                //     $item->weight(0);
                //     $item->append('admin.tradevillage.districts.create');
                //     $item->route('admin.tradevillage.districts.index');
                //     $item->authorize(
                //         $this->auth->hasAccess('tradevillage.districts.index')
                //     );
                // });

            });
            
        });

        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('tradevillage::trade_villages.title.education'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );

                $item->item(trans('tradevillage::course_comments.title.course_comments'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->route('admin.tradevillage.course_comments.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.course_comments.index')
                    );
                });

                $item->item(trans('tradevillage::course_rates.title.course_rates'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->route('admin.tradevillage.course_rates.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.course_rates.index')
                    );
                });

                $item->item(trans('tradevillage::courses.title.courses'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.courses.create');
                    $item->route('admin.tradevillage.courses.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.courses.index')
                    );
                });

                $item->item(trans('tradevillage::lessons.title.lessons'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.lessons.create');
                    $item->route('admin.tradevillage.lessons.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.lessons.index')
                    );
                });
                $item->item(trans('tradevillage::edu_fields.title.edu_fields'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.edu_fields.create');
                    $item->route('admin.tradevillage.edu_fields.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.edu_fields.index')
                    );
                });
                $item->item(trans('tradevillage::documents.title.documents'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.documents.create');
                    $item->route('admin.tradevillage.documents.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.documents.index')
                    );
                });
                
                $item->item(trans('tradevillage::edu_course_fields.title.edu_course_fields'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.edu_course_fields.create');
                    $item->route('admin.tradevillage.edu_course_fields.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.edu_course_fields.index')
                    );
                });

                $item->item(trans('tradevillage::course_users.title.course_users'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.course_users.create');
                    $item->route('admin.tradevillage.course_users.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.course_users.index')
                    );
                });

                $item->item(trans('tradevillage::videos.title.videos'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.tradevillage.video.create');
                    $item->route('admin.tradevillage.video.index');
                    $item->authorize(
                        $this->auth->hasAccess('tradevillage.videos.index')
                    );
                });
            });
            
        });

        return $menu;
    }
}
