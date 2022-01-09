<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'tenSlider', 'hinhAnh','moTa', 'trangThai'
    ];
    protected $primaryKey = 'maSlider';
 	protected $table = 'slider';
}
