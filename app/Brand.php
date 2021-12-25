<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'tenThuongHieu', 'slug', 'moTaThuongHieu','trangThai'
    ];
    protected $primaryKey = 'maThuongHieu';
 	protected $table = 'thuonghieu';
}
