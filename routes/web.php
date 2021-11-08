<?php

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

// Frontend // 
Route::get('/', 'HomeController@index');
Route::get('/trang-chu.html', 'HomeController@index');
Route::get('/cart.html', 'HomeController@cart');
Route::get('/product.html', 'HomeController@product');
Route::get('/product-details.html', 'HomeController@productDetails');
Route::get('/category-product.html', 'HomeController@Categoryproduct');
Route::get('/login.html', 'HomeController@login');
Route::get('/checkout.html', 'HomeController@checkout');
Route::get('/contact.html', 'HomeController@contact');
Route::get('/danh-muc-bai-viet.html', 'NewsController@danhMucBaiViet');
Route::get('/chi-tiet-bai-viet.html', 'NewsController@hienThiBaiViet');


// Backend //
Route::get('/admin', 'AdminController@adminPage');
Route::get('/admin-login.html', 'AdminController@adminLogin');
Route::get('/liet-ke-user.html', 'AdminController@lietKeUser');
Route::get('/them-user.html', 'AdminController@themUser');
Route::get('/liet-ke-danh-muc-san-pham.html', 'AdminController@lietKeDanhMucSanPham');


