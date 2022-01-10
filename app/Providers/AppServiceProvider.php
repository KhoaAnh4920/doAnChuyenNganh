<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use View;
use App\Slider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Sidebar //
        $all_brands = DB::table("thuonghieu")
        ->leftJoin("dbsanpham", function($join){
            $join->on("thuonghieu.mathuonghieu", "=", "dbsanpham.mathuonghieu");
        })
        ->select("thuonghieu.*", DB::raw('count(dbsanpham.masanpham) as sl'))
        ->where('thuonghieu.trangThai', 1)
        ->groupBy("thuonghieu.maThuongHieu")
        ->get();

        $all_category_products = DB::table('danhmucsanpham')->where('danhmucsanpham.trangThai', 1)->orderby('maDanhMuc')->get();
        // Đếm số lượng danh mục con của từng danh mục cha //
        $count_danhMucCon = DB::table('danhmucsanpham')
        ->select( "danhmucsanpham.maDanhMuc as maDanhMucCha","danhmucsanpham.tenDanhMuc","danhmucsanpham.slug",DB::raw('(select count(*) from danhmucsanpham where danhmucsanpham.danhMucCha = maDanhMucCha) as SL'))
        ->where('danhmucsanpham.danhMucCha', 0)
        ->get();
        // end sidebar//

        // Header //
        $cate_of_Apple = DB::table("danhmucsanpham")
            ->whereRaw('danhmucsanpham.maDanhMuc IN (select dbsanpham.maDanhMuc FROM dbsanpham JOIN thuonghieu on thuonghieu.maThuongHieu = dbsanpham.maThuongHieu WHERE thuonghieu.maThuongHieu = 1)')
            ->get();
        $cate_of_Gear = DB::table("danhmucsanpham")
            ->select('tenDanhMuc', 'slug')
            ->where('danhMucCha', 14)
            ->get();
        // end header //

        // Lấy slider //
        $all_slider = Slider::where('trangThai', 1)->orderBy('maSlider', 'ASC')->get();

        // Share data cho tất cả các view //
        View::share('cate_of_Apple', $cate_of_Apple);
        View::share('cate_of_Gear', $cate_of_Gear);
        View::share('all_category_products', $all_category_products);
        View::share('all_brands', $all_brands);
        View::share('all_slider', $all_slider);
        View::share('count_danhMucCon', $count_danhMucCon);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
