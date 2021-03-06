<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'tenSanPham', 'slug', 'giaSanPham','moTaSanPham', 'hinhAnh', 'maThuongHieu', 'maDanhMuc', 'trangThai'
    ];
    protected $primaryKey = 'maSanPham';
 	protected $table = 'dbsanpham';
    
    public function Gallimage(){
        $this->hasMany('App\GalleryImage');
    }
    public function cate_product(){
        return $this->belongsTo('App\CategoryProduct', 'maDanhMuc');
    }
}
