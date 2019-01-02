<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (file_exists(base_path('routes/web.php'))) {
            require base_path('routes/web.php');

            $menu = Menu::where('name', 'admin')->firstOrFail();

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Dashboard',
                'url'        => route('voyager.dashboard', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-boat',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 1,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Media',
                'url'        => route('voyager.media.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-images',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 5,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Posts',
                'url'        => route('voyager.posts.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-news',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 6,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Users',
                'url'        => route('voyager.users.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-person',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 3,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Categories',
                'url'        => route('voyager.categories.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-categories',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 8,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Pages',
                'url'        => route('voyager.pages.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-file-text',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 7,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Roles',
                'url'        => route('voyager.roles.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-lock',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 2,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Menu Builder',
                'url'        => route('voyager.menus.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-list',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 10,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Database',
                'url'        => route('voyager.database.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-data',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 11,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Settings',
                'url'        => route('voyager.settings.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-settings',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 12,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'   => $menu->id,
                'title'     => 'Providers',
                'url'       => route('voyager.providers.index', [], false),
            ]);
            if(!$menuItem->exists) {
                $menuItem->fill([
                    'target'    => '_self',
                    'icon_class'=> 'voyager-people',
                    'color'     => null,
                    'parent_id' => null,
                    'order'     => 13
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Instructors',
                'url'        => route('voyager.instructors.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-pirate',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 14,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Locations',
                'url'        => route('voyager.locations.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-location',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 15,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Learning Method',
                'url'        => route('voyager.learning-methods.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-study',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 16,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Industry',
                'url'        => route('voyager.industries.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-shop',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 17,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Banner',
                'url'        => route('voyager.banners.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-images',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 18,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Content',
                'url'        => route('voyager.contents.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-news',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 19,
                ])->save();
            }


            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Video',
                'url'        => route('voyager.videos.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-video',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 20,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Affiliate',
                'url'        => route('voyager.affiliates.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-people',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 21,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Topic',
                'url'        => route('voyager.topics.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-news',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 22,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Products',
                'url'        => route('voyager.products.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-list',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 23,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Bundle',
                'url'        => route('voyager.bundles.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-treasure',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 24,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Promo',
                'url'        => route('voyager.promo.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-key',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 25,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Review',
                'url'        => route('voyager.rating-reviews.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-pen',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 26,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Post Tags',
                'url'        => route('voyager.post-tags.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-list',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 27,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Categories Classifications',
                'url'        => route('voyager.categories-classification.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-categories',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 28,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Professions',
                'url'        => route('voyager.professions.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-ship',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 29,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Testimonial',
                'url'        => route('voyager.testimonies.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-ship',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 30,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'News',
                'url'        => route('voyager.news.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-news',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 30,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Landing Page',
                'url'        => route('voyager.landing-pages.index', [], false),
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-html5',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 31,
                ])->save();
            }
        }
    }
}
