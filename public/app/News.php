<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'tieuDe', 'slug', 'moTa', 'noiDung','hinhAnh', 'maDanhMuc', 'trangThai', 'users_id', 'created_at'
    ];
    protected $primaryKey = 'maBaiViet';
 	protected $table = 'baiviet';

    public function cate_post(){
        return $this->belongsTo('App\CateNews', 'maDanhMuc');
    }
}
