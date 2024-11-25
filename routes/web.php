<?php

use App\Http\Controllers\Generator\SequenceCodeController;

use App\Http\Controllers\Generator\PerguruanController;
use App\Http\Controllers\Generator\ServiceController;
use App\Http\Controllers\Generator\PengurusController;
use App\Http\Controllers\Generator\SliderController;
use App\Http\Controllers\Generator\GalleryController;
use App\Http\Controllers\Generator\ContactController;
use App\Http\Controllers\Generator\AboutController;
use App\Http\Controllers\Generator\UnlatController;
use App\Http\Controllers\Generator\SabukController;
use App\Http\Controllers\Generator\AgamaController;

use App\Http\Controllers\Generator\CategoryController;

use App\Http\Controllers\ApiDocController;

use App\Http\Controllers\AgiController;
use App\Http\Controllers\CacheController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupConttroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
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

/**
 * @author Dodi Priyanto<dodi.priyanto76@gmail.com>
 */

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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/pengurus', [HomeController::class, 'pengurus'])->name('pengurus');
Route::get('/biodata/{id}', [HomeController::class, 'biodata'])->name('biodata');
Route::post('/flush-cache', [CacheController::class, 'flushCache']);

// Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials');

Auth::routes();

Route::group(['prefix' => 'administrator', 'middleware' => ['auth', 'roles']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/delete_file', [DashboardController::class, 'deleteFileContent'])->name('file_delete');


    Route::group(['prefix' => 'sequencecodes'], function () {
        Route::get('/', [SequenceCodeController::class, 'index'])->name('dashboard_sequencecodes');
        Route::get('/get', [SequenceCodeController::class, 'get'])->name('dashboard_sequencecodes_detail');
        Route::get('/delete', [SequenceCodeController::class, 'destroy'])->name('dashboard_sequencecodes_delete');
        Route::post('/', [SequenceCodeController::class, 'store'])->name('dashboard_sequencecodes_post');
        Route::get('/datatable.json', [SequenceCodeController::class, '__datatable'])->name('dashboard_sequencecodes_table');
    });

    Route::group(['prefix' => 'perguruans'], function () {
        Route::get('/', [PerguruanController::class, 'index'])->name('dashboard_perguruans');
        Route::get('/get', [PerguruanController::class, 'get'])->name('dashboard_perguruans_detail');
        Route::get('/delete', [PerguruanController::class, 'destroy'])->name('dashboard_perguruans_delete');
        Route::post('/', [PerguruanController::class, 'store'])->name('dashboard_perguruans_post');
        Route::get('/datatable.json', [PerguruanController::class, '__datatable'])->name('dashboard_perguruans_table');
    });

    Route::group(['prefix' => 'services'], function () {
        Route::get('/', [ServiceController::class, 'index'])->name('dashboard_services');
        Route::get('/get', [ServiceController::class, 'get'])->name('dashboard_services_detail');
        Route::get('/delete', [ServiceController::class, 'destroy'])->name('dashboard_services_delete');
        Route::post('/', [ServiceController::class, 'store'])->name('dashboard_services_post');
        Route::get('/datatable.json', [ServiceController::class, '__datatable'])->name('dashboard_services_table');
    });

    Route::group(['prefix' => 'penguruses'], function () {
        Route::get('/', [PengurusController::class, 'index'])->name('dashboard_penguruses');
        Route::get('/get', [PengurusController::class, 'get'])->name('dashboard_penguruses_detail');
        Route::get('/delete', [PengurusController::class, 'destroy'])->name('dashboard_penguruses_delete');
        Route::post('/', [PengurusController::class, 'store'])->name('dashboard_penguruses_post');
        Route::get('/datatable.json', [PengurusController::class, '__datatable'])->name('dashboard_penguruses_table');
    });

    Route::group(['prefix' => 'sliders'], function () {
        Route::get('/', [SliderController::class, 'index'])->name('dashboard_sliders');
        Route::get('/get', [SliderController::class, 'get'])->name('dashboard_sliders_detail');
        Route::get('/delete', [SliderController::class, 'destroy'])->name('dashboard_sliders_delete');
        Route::post('/', [SliderController::class, 'store'])->name('dashboard_sliders_post');
        Route::get('/datatable.json', [SliderController::class, '__datatable'])->name('dashboard_sliders_table');
    });

    Route::group(['prefix' => 'galleries'], function () {
        Route::get('/', [GalleryController::class, 'index'])->name('dashboard_galleries');
        Route::get('/get', [GalleryController::class, 'get'])->name('dashboard_galleries_detail');
        Route::get('/delete', [GalleryController::class, 'destroy'])->name('dashboard_galleries_delete');
        Route::post('/', [GalleryController::class, 'store'])->name('dashboard_galleries_post');
        Route::get('/datatable.json', [GalleryController::class, '__datatable'])->name('dashboard_galleries_table');
    });

    Route::group(['prefix' => 'contacts'], function () {
        Route::get('/', [ContactController::class, 'index'])->name('dashboard_contacts');
        Route::get('/get', [ContactController::class, 'get'])->name('dashboard_contacts_detail');
        Route::get('/delete', [ContactController::class, 'destroy'])->name('dashboard_contacts_delete');
        Route::post('/', [ContactController::class, 'store'])->name('dashboard_contacts_post');
        Route::get('/datatable.json', [ContactController::class, '__datatable'])->name('dashboard_contacts_table');
    });

    Route::group(['prefix' => 'abouts'], function () {
        Route::get('/', [AboutController::class, 'index'])->name('dashboard_abouts');
        Route::get('/get', [AboutController::class, 'get'])->name('dashboard_abouts_detail');
        Route::get('/delete', [AboutController::class, 'destroy'])->name('dashboard_abouts_delete');
        Route::post('/', [AboutController::class, 'store'])->name('dashboard_abouts_post');
        Route::get('/datatable.json', [AboutController::class, '__datatable'])->name('dashboard_abouts_table');
    });

    Route::group(['prefix' => 'unlats'], function () {
        Route::get('/', [UnlatController::class, 'index'])->name('dashboard_unlats');
        Route::get('/get', [UnlatController::class, 'get'])->name('dashboard_unlats_detail');
        Route::get('/delete', [UnlatController::class, 'destroy'])->name('dashboard_unlats_delete');
        Route::post('/', [UnlatController::class, 'store'])->name('dashboard_unlats_post');
        Route::get('/datatable.json', [UnlatController::class, '__datatable'])->name('dashboard_unlats_table');
    });

    Route::group(['prefix' => 'sabuks'], function () {
        Route::get('/', [SabukController::class, 'index'])->name('dashboard_sabuks');
        Route::get('/get', [SabukController::class, 'get'])->name('dashboard_sabuks_detail');
        Route::get('/delete', [SabukController::class, 'destroy'])->name('dashboard_sabuks_delete');
        Route::post('/', [SabukController::class, 'store'])->name('dashboard_sabuks_post');
        Route::get('/datatable.json', [SabukController::class, '__datatable'])->name('dashboard_sabuks_table');
    });

    Route::group(['prefix' => 'agamas'], function () {
        Route::get('/', [AgamaController::class, 'index'])->name('dashboard_agamas');
        Route::get('/get', [AgamaController::class, 'get'])->name('dashboard_agamas_detail');
        Route::get('/delete', [AgamaController::class, 'destroy'])->name('dashboard_agamas_delete');
        Route::post('/', [AgamaController::class, 'store'])->name('dashboard_agamas_post');
        Route::get('/datatable.json', [AgamaController::class, '__datatable'])->name('dashboard_agamas_table');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('dashboard_categories');
        Route::get('/get', [CategoryController::class, 'get'])->name('dashboard_categories_detail');
        Route::get('/delete', [CategoryController::class, 'destroy'])->name('dashboard_categories_delete');
        Route::post('/', [CategoryController::class, 'store'])->name('dashboard_categories_post');
        Route::get('/datatable.json', [CategoryController::class, '__datatable'])->name('dashboard_categories_table');
    });
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('dashboard_profile');
        Route::post('/', [ProfileController::class, 'store'])->name('dashboard_profile_post');
    });

    Route::group(['prefix' => 'menu'], function () {
        Route::get('/', [MenuController::class, 'index'])->name('dashboard_menu');
        Route::get('/get', [MenuController::class, 'get'])->name('dashboard_menu_detail');

        Route::get('/get-parent', [MenuController::class, 'getParent'])->name('dashboard_menu_get_parent');

        Route::get('/delete', [MenuController::class, 'destroy'])->name('dashboard_menu_delete');
        Route::post('/', [MenuController::class, 'store'])->name('dashboard_menu_post');
        Route::get('/datatable.json', [MenuController::class, '__datatable'])->name('dashboard_menu_table');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('dashboard_user');
        Route::get('/get', [UserController::class, 'get'])->name('dashboard_user_detail');
        Route::get('/delete', [UserController::class, 'destroy'])->name('dashboard_user_delete');
        Route::post('/', [UserController::class, 'store'])->name('dashboard_user_post');
        Route::get('/datatable.json', [UserController::class, '__datatable'])->name('dashboard_user_table');
        Route::get('/download-user', [UserController::class, 'downloadUsers'])->name('dashboard_user_download');
        Route::get('/get-code', [UserController::class, 'generateUserCode'])->name('dashboard_request_user_register_generate_code');
    });

    Route::group(['prefix' => 'group'], function () {
        Route::get('/', [GroupConttroller::class, 'index'])->name('dashboard_group');
        Route::get('/get', [GroupConttroller::class, 'get'])->name('dashboard_group_detail');
        Route::get('/delete', [GroupConttroller::class, 'destroy'])->name('dashboard_group_delete');
        Route::post('/', [GroupConttroller::class, 'store'])->name('dashboard_group_post');
        Route::get('/changeAccess', [GroupConttroller::class, 'changeAccess'])->name('dashboard_group_change_access');
        Route::get('/datatable.json', [GroupConttroller::class, '__datatable'])->name('dashboard_group_table');
        Route::get('/menuAccess.json', [GroupConttroller::class, '__menuAccess'])->name('dashboard_group_menu_access');
    });

    Route::group(['prefix' => 'setting'], function () {
        Route::get('/', [SettingController::class, 'index'])->name('dashboard_setting');
        Route::get('/get', [SettingController::class, 'get'])->name('dashboard_setting_detail');
        Route::get('/delete', [SettingController::class, 'destroy'])->name('dashboard_setting_delete');
        Route::post('/', [SettingController::class, 'store'])->name('dashboard_setting_post');
        Route::get('/datatable.json', [SettingController::class, '__datatable'])->name('dashboard_setting_table');
    });

    Route::group(['prefix' => 'permission'], function () {
        Route::get('/administrator/permission', [MenuController::class, 'index'])->name('dashboard_permission');
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
