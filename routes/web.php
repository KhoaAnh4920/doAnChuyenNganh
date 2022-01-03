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

Route::get('/product.html', 'ProductController@product');

Route::get('/login.html', 'HomeController@login');
Route::post('/load_more_news', 'NewsController@load_more_news');

Route::get('/contact.html', 'HomeController@contact');
Route::get('/danh-muc-bai-viet.html/{tenDanhMuc}', 'NewsController@danhMucBaiViet');
Route::get('/chi-tiet-bai-viet.html/{new_slug}', 'NewsController@hienThiBaiViet');
Route::post('/login-users', 'AdminController@loginUser');
Route::get('/logoutUser.html', 'AdminController@logoutUser');

// Gio hang // 
Route::get('/cart.html', 'CartController@cart');
Route::post('/add-to-cart.html', 'CartController@addCart');
Route::get('/delete-item-cart/{row_id}', 'CartController@DeleteItemCart');
Route::get('/delete-item-cart', 'CartController@DeleteAllCart');
Route::post('/update-cart', 'CartController@updateCart');
Route::get('/checkout.html', 'HomeController@checkout');
Route::get('/checkout-detail.html/{order_id}', 'HomeController@checkoutDetail');
Route::get('/order.html', 'CartController@order');
Route::post('/handle-order', 'CartController@handleOrder');

// Backend //
Route::post('/login-admin', 'AdminController@loginAdmin');
Route::post('/admin-dashboard.html', 'AdminController@adminPage');
Route::get('/admin', 'AdminController@adminPage');
Route::get('/admin.html', 'AdminController@adminPage');
Route::get('/admin-login.html', 'AdminController@adminLogin');
Route::get('/logoutAdmin.html', 'AdminController@logoutAdmin');
Route::get('/liet-ke-user.html', 'AdminController@lietKeUser');
Route::get('/sua-user.html/{users_id}', 'AdminController@suaUser');
Route::get('/them-user.html', 'AdminController@themUser');
Route::post('/create-users.html', 'AdminController@createUsers');
Route::post('/update-users.html/{users_id}', 'AdminController@updateUsers');
Route::get('/xoa-user.html/{users_id}', 'AdminController@deleteUsers');

// Danh mục sản phẩm //
Route::get('/liet-ke-danh-muc-san-pham.html', 'CategoryProductController@lietKeDanhMucSanPham');
Route::get('/them-danh-muc-san-pham.html', 'CategoryProductController@themDanhMucSanPham');
Route::get('/sua-danh-muc-san-pham.html/{cate_product_id}', 'CategoryProductController@suaDanhMucSanPham');
Route::post('/create-category-product.html', 'CategoryProductController@createCategoryProduct');
Route::post('/update-category-product.html/{cate_product_id}', 'CategoryProductController@updateCategoryProduct');
Route::get('/xoa-danh-muc-san-pham.html/{cate_product_id}', 'CategoryProductController@xoaDanhMucSanPham');
Route::post('/product-tabs', 'CategoryProductController@product_tabs');
Route::get('/category-product.html/{cate_slug}', 'CategoryProductController@Categoryproduct');


//Thương hiệu sản phẩm //
Route::get('/liet-ke-thuong-hieu.html', 'BrandController@lietKeThuongHieu');
Route::get('/sua-thuong-hieu.html/{brand_id}', 'BrandController@suaThuongHieu');
Route::get('/them-thuong-hieu.html', 'BrandController@themThuongHieu');
Route::post('/create-brand.html', 'BrandController@createBrand');
Route::post('/update-brand.html/{brand_id}', 'BrandController@updateBrand');
Route::get('/xoa-thuong-hieu.html/{brand_id}', 'BrandController@xoaThuongHieu');
Route::get('/brands-product.html/{brand_slug}', 'BrandController@Brandproduct');


// Sản phẩm //
Route::get('/liet-ke-san-pham.html', 'ProductController@lietKeSanPham');
Route::get('/sua-san-pham.html/{pro_id}', 'ProductController@suaSanPham');
Route::get('/them-san-pham.html', 'ProductController@themSanPham');
Route::post('/create-product.html', 'ProductController@createProduct');
Route::post('/update-product.html/{pro_id}', 'ProductController@updateProduct');
Route::get('/product-details.html/{pro_slug}', 'ProductController@productDetails');
Route::get('/xoa-san-pham.html/{pro_id}', 'ProductController@xoaSanPham');
Route::post('/set-gallerySession', 'ProductController@setSession');
Route::get('/search-result', 'ProductController@searchProduct');

//  Đơn hàng //
Route::get('/liet-ke-don-hang.html', 'OrderController@lietKeDonHang');
Route::get('/chi-tiet-don-hang.html/{order_id}', 'OrderController@chiTietDonHang');
Route::get('/sua-khach-hang.html', 'OrderController@suaKhachHang');
Route::get('/sua-chi-tiet-don-hang.html', 'OrderController@suaChiTietDonHang');
Route::get('/them-don-hang.html', 'OrderController@themDonHang');
Route::post('/update-qty-product', 'OrderController@update_qty');
Route::post('/update-status-order', 'OrderController@update_status_order');

// Danh mục bài viết //
Route::get('/liet-ke-danh-muc-bai-viet.html', 'CategoryNewsController@lietKeDanhMucBaiViet');
Route::get('/them-danh-muc-bai-viet.html', 'CategoryNewsController@themDanhMucBaiViet');
Route::get('/sua-danh-muc-bai-viet.html/{cate_id}', 'CategoryNewsController@suaDanhMucBaiViet');
Route::get('/xoa-danh-muc-bai-viet.html/{cate_id}', 'CategoryNewsController@xoaDanhMucBaiViet');
Route::post('/create-category-news', 'CategoryNewsController@createCategory');
Route::post('/update-category-news/{cate_id}', 'CategoryNewsController@updateCategory');

// Bài viết //
Route::get('/liet-ke-bai-viet.html', 'NewsController@tatCaBaiViet');
Route::get('/them-bai-viet.html', 'NewsController@themBaiViet');
Route::get('/sua-bai-viet.html/{news_id}', 'NewsController@suaBaiViet');
Route::post('/update-news/{news_id}', 'NewsController@updateNews');
Route::get('/xoa-bai-viet.html/{news_id}', 'NewsController@xoaBaiViet');
Route::post('/create-news', 'NewsController@createNews');

// Danh mục hình // 
// Route::get('/liet-ke-danh-muc-hinh.html/{pro_id}', 'galleryController@lietKeDanhMucHinh');
// Route::get('/them-danh-muc-hinh.html', 'galleryController@themDanhMucHinh');
// Route::get('/sua-danh-muc-hinh.html', 'galleryController@suaDanhMucHinh');
// Route::post('/hien-thi-danh-muc-hinh', 'galleryController@hienThiDanhMuc');
// Route::post('/insert-gallery/{pro_id}', 'galleryController@insertGallery');
// Route::get('/delete-gallery/{pro_id}', 'galleryController@deleteGallery');
// Route::post('/update-gallery', 'galleryController@updateGallery');

//Slider //
Route::get('/liet-ke-slider.html', 'HomeController@lietKeSlider');
Route::get('/them-slider.html', 'HomeController@themSlider');
Route::get('/delete-slider/{slide_id}', 'HomeController@deleteSlider');
Route::post('/create-slider', 'HomeController@createSlider');

//
Route::get('/forgot-password.html', 'HomeController@forgotPass');
Route::post('/recover-pass', 'MailController@recover_pass');
Route::get('/update-new-pass', 'MailController@updateNewPass');
Route::get('/actice-account', 'MailController@activeAccount');
Route::post('/update-pass-handle', 'MailController@handleUpdatePass');
Route::post('/signin-users.html', 'MailController@signInUser');


