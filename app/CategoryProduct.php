<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'tenDanhMuc', 'slug', 'moTaDanhMuc','danhMucCha', 'trangThai'
    ];
    protected $primaryKey = 'maDanhMuc';
 	protected $table = 'danhmucsanpham';
}
