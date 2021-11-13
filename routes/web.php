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
Route::get('/cart.html', 'CartController@cart');
Route::get('/product.html', 'ProductController@product');
Route::get('/product-details.html', 'ProductController@productDetails');
Route::get('/category-product.html', 'CategoryProductController@Categoryproduct');
Route::get('/login.html', 'HomeController@login');
Route::get('/checkout.html', 'HomeController@checkout');
Route::get('/contact.html', 'HomeController@contact');
Route::get('/danh-muc-bai-viet.html', 'NewsController@danhMucBaiViet');
Route::get('/chi-tiet-bai-viet.html', 'NewsController@hienThiBaiViet');


// Backend //
Route::post('/admin-dashboard', 'AdminController@dashboard');
Route::get('/admin', 'AdminController@adminPage');
Route::get('/admin-login.html', 'AdminController@adminLogin');
Route::get('/liet-ke-user.html', 'AdminController@lietKeUser');
Route::get('/sua-user.html', 'AdminController@suaUser');
Route::get('/them-user.html', 'AdminController@themUser');

Route::get('/liet-ke-danh-muc-san-pham.html', 'CategoryProductController@lietKeDanhMucSanPham');
Route::get('/them-danh-muc-san-pham.html', 'CategoryProductController@themDanhMucSanPham');
Route::get('/sua-danh-muc-san-pham.html', 'CategoryProductController@suaDanhMucSanPham');


Route::get('/liet-ke-thuong-hieu.html', 'BrandController@lietKeThuongHieu');
Route::get('/sua-thuong-hieu.html', 'BrandController@suaThuongHieu');
Route::get('/them-thuong-hieu.html', 'BrandController@themThuongHieu');


Route::get('/liet-ke-san-pham.html', 'ProductController@lietKeSanPham');
Route::get('/sua-san-pham.html', 'ProductController@suaSanPham');
Route::get('/them-san-pham.html', 'ProductController@themSanPham');

Route::get('/liet-ke-don-hang.html', 'AdminController@lietKeDonHang');
Route::get('/chi-tiet-don-hang.html', 'AdminController@chiTietDonHang');
Route::get('/sua-khach-hang.html', 'AdminController@suaKhachHang');
Route::get('/sua-chi-tiet-don-hang.html', 'AdminController@suaChiTietDonHang');

Route::get('/liet-ke-danh-muc-bai-viet.html', 'CategoryNewsController@lietKeDanhMucBaiViet');
Route::get('/them-danh-muc-bai-viet.html', 'CategoryNewsController@themDanhMucBaiViet');
Route::get('/sua-danh-muc-bai-viet.html', 'CategoryNewsController@suaDanhMucBaiViet');

Route::get('/tat-ca-bai-viet.html', 'NewsController@tatCaBaiViet');
Route::get('/them-bai-viet.html', 'NewsController@themBaiViet');
Route::get('/sua-bai-viet.html', 'NewsController@suaBaiViet');

Route::get('/liet-ke-danh-muc-hinh.html', 'galleryController@lietKeDanhMucHinh');
Route::get('/them-danh-muc-hinh.html', 'galleryController@themDanhMucHinh');
Route::get('/sua-danh-muc-hinh.html', 'galleryController@suaDanhMucHinh');