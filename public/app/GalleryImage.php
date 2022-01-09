<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'maSanPham', 'hinh'
    ];
    protected $primaryKey = 'maHinhSanPham';
 	protected $table = 'danhmuchinh';
}
