<?php

use App\Http\Controllers\FrontendController;
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

Route::get('/', function () {
    return redirect(app()->getLocale());
});
Route::get('admin', function () {
    return redirect(app()->getLocale() . '/admin');
});

Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setlocale'], function() {
    Route::get('auth/login', 'AuthController@getLogin')->name('auth-login-get');
    Route::get('auth/logout', 'AuthController@logout')->name('auth-logout-get');
    Route::post('auth/login', 'AuthController@authenticate')->name('auth-login-post');;
    Route::get('auth/not-permis', 'AuthController@notPermis')->name('auth-not-permis');;
    Route::get('slug/{str}', 'ObjectController@getSlug')->name('slug-string');
    Route::post('image/uploads', 'ImageController@uploads')->name('image-upload-post')->middleware('checkauth');
    Route::get('image/delete/{filename}', 'ImageController@delete')->middleware('checkauth');
    Route::post('file/uploads/{fileID}', 'FileController@fileUploads')->middleware('checkauth');
    Route::post('file/uploads', 'FileController@uploads')->middleware('checkauth');
    Route::post('file/upload-json/{fileID}', 'FileController@upload_json')->middleware('checkauth');
    Route::get('file/delete/{filename}', 'FileController@delete')->middleware('checkauth');
    Route::get('file/download/{filename}', 'FileController@download')->middleware('checkauth');
    Route::get('address/get/{id}', 'DMDiaChiController@getOptions')->middleware('checkauth');
    Route::get('address/get/{id}/{id1}', 'DMDiaChiController@getOptions1')->middleware('checkauth');

    Route::get('/', 'FrontendController@index')->name('trang-chu');
    Route::get('lien-he', 'FrontendController@lien_he')->name('lien-he');
    Route::get('contacts', 'FrontendController@lien_he')->name('contacts');
    Route::get('tong-quan', 'FrontendController@tong_quan')->name('gioi-thieu-tong-quan');
    Route::get('overview', 'FrontendController@tong_quan')->name('introduction-overview');
    Route::get('nhan-su/{slug}', 'FrontendController@nhan_su')->name('gioi-thieu-nhan-su');


    Route::get('tin-tuc-su-kien/tag/{key}', 'FrontendController@tin_tuc_su_kien_tag');
    Route::get('tin-tuc-su-kien', 'FrontendController@tin_tuc_su_kien');
    Route::get('tin-tuc-su-kien/xem-truc-tuyen/{id}/{key}', 'FrontendController@tin_tuc_su_kien_xtt')->name('tin-tuc-su-kien-xem-truc-tuyen');
    Route::get('tin-tuc-su-kien/tai-ve/{id}/{key}', 'FrontendController@tin_tuc_su_kien_tv')->name('tin-tuc-su-kien-tai-ve');
    Route::get('tin-tuc-su-kien/{slug}', 'FrontendController@tin_tuc_su_kien_ct');
    Route::get('news-and-events/tag/{key}', 'FrontendController@tin_tuc_su_kien_tag');
    Route::get('news-and-events', 'FrontendController@tin_tuc_su_kien');
    Route::get('news-and-events/xem-truc-tuyen/{id}/{key}', 'FrontendController@tin_tuc_su_kien_xtt')->name('news-and-events-xem-truc-tuyen');
    Route::get('news-and-events/tai-ve/{id}/{key}', 'FrontendController@tin_tuc_su_kien_tv')->name('news-and-events-tai-ve');
    Route::get('news-and-events/{slug}', 'FrontendController@tin_tuc_su_kien_ct');
    
    Route::get('dao-tao', 'FrontendController@dao_tao');
    Route::get('dao-tao/tag/{tags}', 'FrontendController@dao_tao_tag');
    Route::get('dao-tao/{slug}', 'FrontendController@dao_tao_ct');

    Route::get('du-an','FrontendController@du_an')->name('du-an');
    Route::get('khoa-luan-tot-nghiep','FrontendController@khoa_luan_tot_nghiep')->name('khoa-luan-tot-nghiep');
    
    Route::get('van-ban','FrontendController@van_ban')->name('van-ban');
    Route::get('van-ban-ct/{slug}','FrontendController@van_ban_ct')->name('van-ban-ct');
    Route::get('van-ban/tai-ve/{id}/{key}','FrontendController@van_ban_tv')->name('van-ban-tai-ve');
    
    Route::get('bieu-mau','FrontendController@bieu_mau')->name('bieu_mau');
    Route::get('bieu-mau-ct/{slug}','FrontendController@bieu_mau_ct')->name('bieu-mau-ct');
    Route::get('bieu-mau/tai-ve/{id}/{key}','FrontendController@bieu_mau_tv')->name('bieu-mau-tai-ve');
    

    Route::group(['prefix' => 'admin',  'middleware' => 'checkauth'], function(){
        Route::get('/', 'AuthController@admin')->middleware('checkauth')->name('admin');
        Route::get('banner', 'BannerController@list')->middleware('role:Admi,Manager,Updater')->name('admin-banner');
        Route::get('banner/add', 'BannerController@add')->middleware('role:Admin,Manager,Updater')->name('admin-banner-add');
        Route::post('banner/create', 'BannerController@create')->middleware('role:Admin,Manager,Updater')->name('admin-banner-create');
        Route::get('banner/edit/{id}', 'BannerController@edit')->middleware('role:Admin,Manager,Updater')->name('admin-banner-edit');
        Route::post('banner/update', 'BannerController@update')->middleware('role:Admin,Manager,Updater')->name('admin-banner-update');
        Route::get('banner/delete/{id}', 'BannerController@delete')->middleware('role:Admin,Manager,Updater')->name('admin-banner-delete');

        Route::get('tong-quan', 'BannerController@tong_quan')->middleware('role:Admi,Manager,Updater')->name('admin-banner-tong-quan');
        Route::post('tong-quan/update', 'BannerController@tong_quan_update')->middleware('role:Admi,Manager,Updater')->name('admin-banner-tong-quan-update');

        Route::get('lien-he', 'BannerController@lien_he')->middleware('role:Admi,Manager,Updater')->name('admin-banner-lien-he');
        Route::post('lien-he/update', 'BannerController@lien_he_update')->middleware('role:Admi,Manager,Updater')->name('admin-banner-lien-he-update');

        Route::get('nhan-su/{arr_bo_phan}', 'NhanSuController@list')->middleware('role:Admi,Manager,Updater')->name('admin-nhan-su');
        Route::get('nhan-su/{arr_bo_phan}/add', 'NhanSuController@add')->middleware('role:Admin,Manager,Updater')->name('admin-nhan-su-add');
        Route::post('nhan-su/{arr_bo_phan}/create', 'NhanSuController@create')->middleware('role:Admin,Manager,Updater')->name('admin-nhan-su-create');
        Route::get('nhan-su/nhan-su/edit/{id}', 'NhanSuController@edit')->middleware('role:Admin,Manager,Updater')->name('admin-nhan-su-edit-id');
        Route::get('nhan-su/chuyen-gia/edit/{id}', 'NhanSuController@edit')->middleware('role:Admin,Manager,Updater')->name('admin-nhan-su-edit-id');
        Route::post('nhan-su/{arr_bo_phan}/update', 'NhanSuController@update')->middleware('role:Admin,Manager,Updater')->name('admin-nhan-su-update');
        Route::get('nhan-su/nhan-su/delete/{id}', 'NhanSuController@delete')->middleware('role:Admin,Manager,Updater')->name('admin-nhan-su-delete');
        Route::get('nhan-su/chuyen-gia/delete/{id}', 'NhanSuController@delete')->middleware('role:Admin,Manager,Updater')->name('admin-nhan-su-delete');

        Route::get('tin-tuc-su-kien', 'TinTucSuKienController@list')->middleware('role:Admi,Manager,Updater')->name('admin-tin-tuc-su-kien');
        Route::get('tin-tuc-su-kien/add', 'TinTucSuKienController@add')->middleware('role:Admin,Manager,Updater')->name('admin-tin-tuc-su-kien-add');
        Route::post('tin-tuc-su-kien/create', 'TinTucSuKienController@create')->middleware('role:Admin,Manager,Updater')->name('admin-tin-tuc-su-kien-create');
        Route::get('tin-tuc-su-kien/edit/{id}', 'TinTucSuKienController@edit')->middleware('role:Admin,Manager,Updater')->name('admin-tin-tuc-su-kien-edit');
        Route::post('tin-tuc-su-kien/update', 'TinTucSuKienController@update')->middleware('role:Admin,Manager,Updater')->name('admin-tin-tuc-su-kien-update');
        Route::get('tin-tuc-su-kien/delete/{id}', 'TinTucSuKienController@delete')->middleware('role:Admin,Manager,Updater')->name('admin-tin-tuc-su-kien-delete');

        Route::get('dao-tao', 'DaoTaoController@list')->middleware('role:Admi,Manager,Updater')->name('admin-dao-tao');
        Route::get('dao-tao/add', 'DaoTaoController@add')->middleware('role:Admin,Manager,Updater')->name('admin-dao-tao-add');
        Route::post('dao-tao/create', 'DaoTaoController@create')->middleware('role:Admin,Manager,Updater')->name('admin-dao-tao-create');
        Route::get('dao-tao/edit/{id}', 'DaoTaoController@edit')->middleware('role:Admin,Manager,Updater')->name('admin-dao-tao-edit');
        Route::post('dao-tao/update', 'DaoTaoController@update')->middleware('role:Admin,Manager,Updater')->name('admin-dao-tao-update');
        Route::get('dao-tao/delete/{id}', 'DaoTaoController@delete')->middleware('role:Admin,Manager,Updater')->name('admin-dao-tao-delete');

        Route::get('nghien-cuu-khoa-hoc', 'NghienCuuKhoaHocController@list')->middleware('role:Admi,Manager,Updater')->name('admin-nghien-cuu-khoa-hoc');
        Route::get('nghien-cuu-khoa-hoc/add', 'NghienCuuKhoaHocController@add')->middleware('role:Admin,Manager,Updater')->name('admin-nghien-cuu-khoa-hoc-add');
        Route::post('nghien-cuu-khoa-hoc/create', 'NghienCuuKhoaHocController@create')->middleware('role:Admin,Manager,Updater')->name('admin-nghien-cuu-khoa-hoc-create');
        Route::get('nghien-cuu-khoa-hoc/edit/{id}', 'NghienCuuKhoaHocController@edit')->middleware('role:Admin,Manager,Updater')->name('admin-nghien-cuu-khoa-hoc-edit');
        Route::post('nghien-cuu-khoa-hoc/update', 'NghienCuuKhoaHocController@update')->middleware('role:Admin,Manager,Updater')->name('admin-nghien-cuu-khoa-hoc-update');
        Route::get('nghien-cuu-khoa-hoc/delete/{id}', 'NghienCuuKhoaHocController@delete')->middleware('role:Admin,Manager,Updater')->name('admin-nghien-cuu-khoa-hoc-delete');

        Route::get('khoa-luan-tot-nghiep', 'KhoaLuanTotNghiepController@list')->middleware('role:Admi,Manager,Updater')->name('admin-khoa-luan-tot-nghiep');
        Route::get('khoa-luan-tot-nghiep/add', 'KhoaLuanTotNghiepController@add')->middleware('role:Admin,Manager,Updater')->name('admin-khoa-luan-tot-nghiep-add');
        Route::post('khoa-luan-tot-nghiep/create', 'KhoaLuanTotNghiepController@create')->middleware('role:Admin,Manager,Updater')->name('admin-khoa-luan-tot-nghiep-create');  
        Route::get('khoa-luan-tot-nghiep/edit/{id}', 'KhoaLuanTotNghiepController@edit')->middleware('role:Admin,Manager,Updater')->name('admin-khoa-luan-tot-nghiep-edit');
        Route::post('khoa-luan-tot-nghiep/update', 'KhoaLuanTotNghiepController@update')->middleware('role:Admin,Manager,Updater')->name('admin-khoa-luan-tot-nghiep-update'); 
        Route::get('khoa-luan-tot-nghiep/delete/{id}', 'KhoaLuanTotNghiepController@delete')->middleware('role:Admin,Manager,Updater')->name('admin-khoa-luan-tot-nghiep-delete');  
       
        Route::get('du-an', 'DuAnController@list')->middleware('role:Admi,Manager,Updater')->name('admin-du-an');
        Route::get('du-an/add', 'DuAnController@add')->middleware('role:Admin,Manager,Updater')->name('admin-du-an-add');
        Route::post('du-an/create', 'DuAnController@create')->middleware('role:Admin,Manager,Updater')->name('admin-du-an-create');
        Route::get('du-an/edit/{id}', 'DuAnController@edit')->middleware('role:Admin,Manager,Updater')->name('admin-du-an-edit');
        Route::post('du-an/update', 'DuAnController@update')->middleware('role:Admin,Manager,Updater')->name('admin-du-an-update');
        Route::get('du-an/delete/{id}', 'DuAnController@delete')->middleware('role:Admin,Manager,Updater')->name('admin-du-an-delete');

        Route::get('hoi-nghi-hoi-thao', 'HoiNghiHoiThaoController@list')->middleware('role:Admi,Manager,Updater')->name('admin-hoi-nghi-hoi-thao');
        Route::get('hoi-nghi-hoi-thao/add', 'HoiNghiHoiThaoController@add')->middleware('role:Admin,Manager,Updater')->name('admin-hoi-nghi-hoi-thao-add');
        Route::post('hoi-nghi-hoi-thao/create', 'HoiNghiHoiThaoController@create')->middleware('role:Admin,Manager,Updater')->name('admin-hoi-nghi-hoi-thao-create');
        Route::get('hoi-nghi-hoi-thao/edit/{id}', 'HoiNghiHoiThaoController@edit')->middleware('role:Admin,Manager,Updater')->name('admin-hoi-nghi-hoi-thao-edit');
        Route::post('hoi-nghi-hoi-thao/update', 'HoiNghiHoiThaoController@update')->middleware('role:Admin,Manager,Updater')->name('admin-hoi-nghi-hoi-thao-update');
        Route::get('hoi-nghi-hoi-thao/delete/{id}', 'HoiNghiHoiThaoController@delete')->middleware('role:Admin,Manager,Updater')->name('admin-hoi-nghi-hoi-thao-delete');

        Route::get('van-ban', 'VanBanController@list')->middleware('role:Admi,Manager,Updater')->name('admin-van-ban');
        Route::get('van-ban/add', 'VanBanController@add')->middleware('role:Admin,Manager,Updater')->name('admin-van-ban-add');
        Route::post('van-ban/create', 'VanBanController@create')->middleware('role:Admin,Manager,Updater')->name('admin-van-ban-create');
        Route::get('van-ban/edit/{id}', 'VanBanController@edit')->middleware('role:Admin,Manager,Updater')->name('admin-van-ban-edit');
        Route::post('van-ban/update', 'VanBanController@update')->middleware('role:Admin,Manager,Updater')->name('admin-van-ban-update');
        Route::get('van-ban/delete/{id}', 'VanBanController@delete')->middleware('role:Admin,Manager,Updater')->name('admin-van-ban-delete');

        Route::get('doi-tac', 'DoiTacController@list')->middleware('role:Admi,Manager,Updater')->name('admin-doi-tac');
        Route::get('doi-tac/add', 'DoiTacController@add')->middleware('role:Admin,Manager,Updater')->name('admin-doi-tac-add');
        Route::post('doi-tac/create', 'DoiTacController@create')->middleware('role:Admin,Manager,Updater')->name('admin-doi-tac-create');
        Route::get('doi-tac/edit/{id}', 'DoiTacController@edit')->middleware('role:Admin,Manager,Updater')->name('admin-doi-tac-edit');
        Route::post('doi-tac/update', 'DoiTacController@update')->middleware('role:Admin,Manager,Updater')->name('admin-doi-tac-update');
        Route::get('doi-tac/delete/{id}', 'DoiTacController@delete')->middleware('role:Admin,Manager,Updater')->name('admin-doi-tac-delete');


        Route::get('user', 'UserController@list')->middleware('role:Admin')->name('admin-user');
        Route::get('user/change-password', 'UserController@change_password')->middleware('role:Admin')->name('admin-change-password');
        Route::post('user/update-password', 'UserController@update_password')->middleware('role:Admin')->name('admin-update-password');
        Route::get('user/add', 'UserController@add')->middleware('role:Admin')->name('admin-user-add');
        Route::post('user/create', 'UserController@create')->middleware('role:Admin')->name('admin-user-create');
        Route::get('user/edit/{id}', 'UserController@edit')->middleware('role:Admin')->name('admin-user-edit');
        Route::post('user/update', 'UserController@update')->middleware('role:Admin')->name('admin-user-update');
        Route::get('user/delete/{id}', 'UserController@delete')->middleware('role:Admin')->name('admin-delete');
        Route::get('translate', 'TranslateController@index')->middleware('role:Admin,Manager,Doctor,Employee')->name('admin-translate');
        Route::get('translate/add', 'TranslateController@add')->middleware('role:Admin,Manager,Doctor,Employee')->name('admin-translate-add');
        Route::post('translate/create', 'TranslateController@create')->middleware('role:Admin,Manager,Updater')->name('admin-translate-create');
        Route::get('translate/edit/{key}', 'TranslateController@edit')->middleware('role:Admin,Manager,Updater')->name('admin-translate-edit');
        Route::post('translate/update', 'TranslateController@update')->middleware('role:Admin,Manager,Updater')->name('admin-translate-update');
        Route::get('translate/delete/{key}', 'TranslateController@delete')->middleware('role:Admin,Manager,Updater')->name('admin-translate-delete');

        Route::get('translate-path', 'TranslatePathController@index')->middleware('role:Admin,Manager,Doctor,Employee')->name('admin-translate-path');
        Route::get('translate-path/add', 'TranslatePathController@add')->middleware('role:Admin,Manager,Doctor,Employee')->name('admin-translate-path-add');
        Route::post('translate-path/create', 'TranslatePathController@create')->middleware('role:Admin,Manager,Updater')->name('admin-translate-path-create');
        Route::get('translate-path/edit/{key}', 'TranslatePathController@edit')->middleware('role:Admin,Manager,Updater')->name('admin-translate-path-edit');
        Route::post('translate-path/update', 'TranslatePathController@update')->middleware('role:Admin,Manager,Updater')->name('admin-translate-path-update');
        Route::get('translate-path/delete/{key}', 'TranslatePathController@delete')->middleware('role:Admin,Manager,Updater')->name('admin-translate-path-delete');

        Route::get('bieu-mau', 'BieuMauController@list')->middleware('role:Admi,Manager,Updater')->name('admin-bieu-mau');
        Route::get('bieu-mau/add', 'BieuMauController@add')->middleware('role:Admin,Manager,Updater')->name('admin-bieu-mau-add');
        Route::post('bieu-mau/create', 'BieuMauController@create')->middleware('role:Admin,Manager,Updater')->name('admin-bieu-mau-create');
        Route::get('bieu-mau/edit/{id}', 'BieuMauController@edit')->middleware('role:Admin,Manager,Updater')->name('admin-bieu-mau-edit');
        Route::post('bieu-mau/update', 'BieuMauController@update')->middleware('role:Admin,Manager,Updater')->name('admin-bieu-mau-update');
        Route::get('bieu-mau/delete/{id}', 'BieuMauController@delete')->middleware('role:Admin,Manager,Updater')->name('admin-bieu-mau-delete');

    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () { 
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
