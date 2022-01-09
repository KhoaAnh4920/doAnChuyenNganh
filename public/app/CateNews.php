<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CateNews extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'tenDanhMuc', 'moTa', 'slug'
    ];
    protected $primaryKey = 'maDanhMuc';
 	protected $table = 'danhmucbaiviet';

    public function post(){
        $this->hasMany('App\News');
    }
}
