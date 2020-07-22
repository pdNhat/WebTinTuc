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

Route::get('/', function () {
    return view('welcome');
});
// thu model

	Route::get('admin/dangnhap','userconTro@getdangnhap');
	Route::post('admin/dangnhap','userconTro@postdangnhap');
	Route::get('admin/logout','userconTro@getlogout');
  

    Route::get('pages/lienhe','pagesconTro@getlienhe');
Route::group(['prefix'=>'admin','middleware'=>'adminlogin'],function(){
	Route::group(['prefix'=>'loaitin'],function(){
		Route::get('danhsach','loaitinconTro@getdanhsach');
	    Route::get('sua/{id}','loaitinconTro@getsua');
	    Route::post('sua/{id}','loaitinconTro@postsua');
	    Route::get('xoa/{id}','loaitinconTro@getxoa');
	    Route::get('them','loaitinconTro@getthem');
	    Route::post('them','loaitinconTro@postthem');
});
	Route::group(['prefix'=>'slide'],function(){
	    Route::get('danhsach','slideconTro@getdanhsach');
	    Route::get('sua','slideconTro@getsua');
	    Route::get('them','slideconTro@getthem');
});
	Route::group(['prefix'=>'theloai'],function(){
	    Route::get('danhsach','theloaiconTro@getdanhsach');
	    Route::get('sua/{id}','theloaiconTro@getsua');
	    Route::post('sua/{id}','theloaiconTro@postsua');
	    Route::get('xoa/{id}','theloaiconTro@getxoa');
	    Route::get('them','theloaiconTro@getthem');
	    Route::post('them','theloaiconTro@postthem');

});
	Route::group(['prefix'=>'tintuc'],function(){
	    Route::get('danhsach','tintucconTro@getdanhsach');
	    Route::get('sua/{id}','tintucconTro@getsua');
	    Route::get('them','tintucconTro@getthem');
	    Route::post('them','tintucconTro@postthem');
	    Route::post('sua/{id}','tintucconTro@postsua');
	    Route::get('xoa/{id}','tintucconTro@getxoa');
});
	Route::group(['prefix'=>'slide'],function(){
	    Route::get('danhsach','slideconTro@getdanhsach');
	    Route::get('sua/{id}','slideconTro@getsua');
	    Route::get('them','slideconTro@getthem');
	    Route::post('them','slideconTro@postthem');
	    Route::post('sua/{id}','slideconTro@postsua');
	    Route::get('xoa/{id}','slideconTro@getxoa');
});
   Route::group(['prefix'=>'users'],function(){
	    Route::get('danhsach','userconTro@getdanhsach');
	    Route::get('sua/{id}','userconTro@getsua');
	    Route::get('them','userconTro@getthem');
	    Route::post('them','userconTro@postthem');
	    Route::post('sua/{id}','userconTro@postsua');
	    Route::get('xoa/{id}','userconTro@getxoa');
});



	Route::group(['prefix'=>'users'],function(){
	   
});
	Route::group(['prefix'=>'comment'],function(){
	    Route::get('xoa/{id}/{idtt}','commentconTro@getxoa');
});
	    Route::group(['prefix'=>'ajax'],function(){

        Route::get('LoaiTin/{idLoaiTin}','ajaxconTro@getajaxlt');

	});
});

 Route::get('pages/trangchu','pagesconTro@gettrangchu');
   Route::get('pages/loaitin/{idlt}/{tenkhongdau}.html','pagesconTro@getloaitin');
   Route::get('pages/tintuc/{idtt}/{tieudekhongdau}.html','pagesconTro@gettintuc');
 Route::get('dangnhap','pagesconTro@getdangnhap');
 Route::post('dangnhap','pagesconTro@postdangnhap');
 Route::get('dangxuat','pagesconTro@getdangxuat');
 Route::post('comment/{id}','commentconTro@comment');
 Route::get('nguoidung','pagesconTro@getnguoidung');
 Route::post('nguoidung','pagesconTro@postnguoidung');
 Route::get('dangky','pagesconTro@getdangky');
 Route::post('dangky','pagesconTro@postdangky');
 Route::get('lienhe','pagesconTro@lienhe');
 Route::post('timkiem','pagesconTro@timkiem');







