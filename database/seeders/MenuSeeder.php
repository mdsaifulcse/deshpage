<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Setting;
use App\Models\SubMenu;
use App\Models\SubSubMenu;
use Illuminate\Database\Seeder;
use DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Setting::insert(['id'=>1,'company_name'=>'Demo Company','company_title'=>'Company Title Here']);


        $menus = [
                [
                    'id'=>'1',
                    'name'=>'Acl',
                    'url'=>'javascript:;',
                    'icon_class'=>'fa fa-home',
                    'serial_num'=>'1',
                    'slug'=>'["menu"]',
                ],

                [
                    'id'=>'2',
                    'name'=>'Setting',
                    'url'=>'javascript:;',
                    'icon_class'=>'fa fa-home',
                    'serial_num'=>'2',
                    'slug'=>'["menu"]',
                ],
        ];


            Menu::insert($menus);

            // -------------------------
        $subMenus = [

            [
                'id'=>'1',
                'menu_id'=>'1',
                'name'=>'Role',
                'url'=>'admin/roles',
                'icon_class'=>'fa fa-home',
                'serial_num'=>'1',
                'slug'=>'["role-delete","role-edit","role-create","role-list"]',
            ],

            [
                'id'=>'2',
                'menu_id'=>'2',
                'name'=>'Menu',
                'url'=>'admin/menu',
                'icon_class'=>'fa fa-home',
                'serial_num'=>'2',
                'slug'=>'["menu"]',
            ],

            [
                'id'=>'3',
                'menu_id'=>'2',
                'name'=>'Categories',
                'url'=>'admin/categories',
                'icon_class'=>'fa fa-home',
                'serial_num'=>'3',
                'slug'=>'["categories"]',
            ],
            [
                'id'=>'4',
                'menu_id'=>'2',
                'name'=>'Divisions',
                'url'=>'admin/divisions',
                'icon_class'=>'fa fa-home',
                'serial_num'=>'4',
                'slug'=>'["divisions"]',
            ],
            [
                'id'=>'5',
                'menu_id'=>'2',
                'name'=>'Slider',
                'url'=>'admin/slider',
                'icon_class'=>'fa fa-home',
                'serial_num'=>'5',
                'slug'=>'["slider"]',
            ],
            [
                'id'=>'6',
                'menu_id'=>'2',
                'name'=>'Social-icon',
                'url'=>'admin/social-icon',
                'icon_class'=>'fa fa-home',
                'serial_num'=>'6',
                'slug'=>'["social-icon"]',
            ],
            [
                'id'=>'7',
                'menu_id'=>'2',
                'name'=>'Testimonial',
                'url'=>'admin/testimonial',
                'icon_class'=>'fa fa-home',
                'serial_num'=>'7',
                'slug'=>'["testimonial"]',
            ],
            [
                'id'=>'8',
                'menu_id'=>'2',
                'name'=>'Faq',
                'url'=>'admin/faq',
                'icon_class'=>'fa fa-home',
                'serial_num'=>'8',
                'slug'=>'["faq"]',
            ],
            [
                'id'=>'9',
                'menu_id'=>'2',
                'name'=>'Client',
                'url'=>'admin/client',
                'icon_class'=>'fa fa-home',
                'serial_num'=>'9',
                'slug'=>'["client"]',
            ],
            [
                'id'=>'10',
                'menu_id'=>'2',
                'name'=>'Pages',
                'url'=>'admin/pages',
                'icon_class'=>'fa fa-home',
                'serial_num'=>'10',
                'slug'=>'["pages"]',
            ],
            [
                'id'=>'11',
                'menu_id'=>'2',
                'name'=>'Site Setting',
                'url'=>'admin/setting',
                'icon_class'=>'fa fa-home',
                'serial_num'=>'11',
                'slug'=>'["setting"]',
            ],
            [
                'id'=>'12',
                'menu_id'=>'2',
                'name'=>'Users',
                'url'=>'admin/users',
                'icon_class'=>'fa fa-user',
                'serial_num'=>'12',
                'slug'=>'["setting"]',
            ],
        ];

        SubMenu::insert($subMenus);

    }
}
