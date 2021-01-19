<?php

namespace App\Providers;

use App\Models\Biggapon;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\SocialIcon;
use Illuminate\Support\ServiceProvider;
use View,MyHelper,Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer( // for admin menu --------------
            [
                'admin.includes.aside',
            ],
            function ($view)
            {
                $menus=Menu::where(['menu_for'=>Menu::ADMIN_MENU,'status'=>Menu::ACTIVE])->orderBy('serial_num','ASC')->get();

                $view->with(['menus'=>$menus]);
            });



        View::composer( // for frontend menu --------------
            [
                'client.layouts.partials.header',
            ],
            function ($view)
            {
                $menus=Category::with('subCatAsSubMenu')->orderBy('serial_num','ASC')
                    ->select('category_name','link','id','icon_class')->where('status','=',Category::ACTIVE)->get();

                $allMenus=Category::with('subCatAsSubMenu')->orderBy('serial_num','ASC')
                    ->select('category_name','link','id','icon_class')->where('status','=',Category::OTHER)->get();
                $allMenus=collect($allMenus);
                $socials=SocialIcon::orderBy('serial_num','ASC')->get();

                $view->with(['menus'=>$menus,'allMenus'=>$allMenus,'socials'=>$socials]);
            });

        View::composer( // for frontend Footer --------------
            [
                'client.layouts.partials.footer',
            ],
            function ($view)
            {
                $setting=Setting::first();

                $view->with(['setting'=>$setting]);
            });

        View::composer( // for frontend Footer --------------
            [
                'client.layouts.master',
            ],
            function ($view)
            {
                $topA=Biggapon::where(['status'=>Biggapon::ACTIVE,'place'=>Biggapon::TOP])->orderBy('serial_num','DESC')->first();
                $bottomA=Biggapon::where(['status'=>Biggapon::ACTIVE,'place'=>Biggapon::BOTTOM])->orderBy('serial_num','DESC')->first();

                $view->with(['topA'=>$topA,'bottomA'=>$bottomA]);
            });

    }
}
