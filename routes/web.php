<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/staff', 'Auth\LoginController@showStaffLoginForm');

//Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
//Route::get('/register/writer', 'Auth\RegisterController@showWriterRegisterForm');

Route::post('/login/staff', 'Auth\LoginController@staffLogin');
Route::post('/login/admin', 'Auth\LoginController@adminLogin');

//Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
//Route::post('/register/writer', 'Auth\RegisterController@createWriter');




Route::get('/load-sub-cat-by-cat/{categoryId}', '\App\CustomFacades\DataLoadController@loadSubCatsByCat');


Route::group(['middleware' => ['auth'],'namespace'=>'Admin','prefix' => 'admin'], function() {

    Route::get('demo-route',function (){
        return view('admin.demo-view');
    });

    Route::get('/home', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('home');

    Route::resource('news','NewsController')->middleware('permission:news-list|news-create|news-edit|news-delete');
    Route::get('/get-news','NewsController@getNewData')->middleware('permission:news-list|news-create|news-edit|news-delete');

    Route::resource('more-news-photo','NewsDetailPhotoController')->middleware('permission:news-list|news-create|news-edit|news-delete');


    Route::resource('biggapons','BiggaponController')->middleware('permission:ads-list|ads-create|ads-edit|ads-delete');
    Route::resource('client','OurClientController')->middleware('permission:client');
    Route::resource('faq','FaqController')->middleware('permission:faq');
    Route::resource('testimonial','TestimonialController')->middleware('permission:testimonial');
    Route::resource('social-icon','SocialIconController')->middleware('permission:social-icon');
    Route::resource('slider','SliderController')->middleware('permission:slider');

    Route::resource('districts','DistrictController')->middleware('permission:districts');
    Route::resource('divisions','DivisionController')->middleware('permission:divisions');

    Route::resource('categories','CategoryController')->middleware('permission:categories');
    Route::resource('sub-categories','SubCategoryController')->middleware('permission:sub-categories');

    Route::resource('pages','PageController')->middleware('permission:pages');


    Route::resource('setting','SettingController')->middleware('permission:setting');

    Route::get('/password', 'ProfileController@changeMyPassword');
    Route::post('/password-change', 'ProfileController@resetMyPassword');

    Route::get('/profile', 'ProfileController@myProfile');
    Route::post('/profile-update', 'ProfileController@updateMyProfile');

    Route::resource('users','UserController')->middleware('permission:user-list|user-create|user-edit|user-delete');

});

Route::group(['middleware' => ['auth'],'namespace'=>'Menu','prefix' => 'admin'], function() {

    Route::resource('menu','MenuController')->middleware('permission:menu');
    Route::resource('sub-menu','SubMenuController')->middleware('permission:menu');
    Route::resource('sub-sub-menu','SubSubMenuController')->middleware('permission:menu');

});
Route::group(['middleware' => ['auth'],'namespace'=>'Spatie','prefix' => 'admin'], function() {

    Route::resource('roles','RoleController')->middleware('permission:role-list|role-create|role-edit|role-delete');
    Route::resource('permission','AclPermissionController')->middleware('role:developer');

});



Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('clear-all','CacheClearController@clearAllAndReset');

Route::group(['namespace'=>'Client'], function() {

    Route::get('/', 'HomeNewsController@index');
    Route::get('/search', 'HomeNewsController@searchResult');

    Route::get('/author/{userId}', 'HomeNewsController@newsAuthor');

    Route::get('/archive', 'ArchiveController@archiveNews');

    Route::get('/about-us.html', 'PageController@aboutUs');

    Route::get('/contact.htm', 'PageController@contactUs');

    Route::post('/user-feedback', 'PageController@saveUserFeedBack');

    Route::get('/page/{link}', 'PageController@pageView');

    Route::get('/topic/{topic}', 'CategoryNewsController@topicalNews');

    Route::get('/{category}/{subCate?}/{newsId?}/{title?}', 'CategoryNewsController@index');


});




//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
