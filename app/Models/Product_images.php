<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_images extends Model
{
    use HasFactory;
    use HasFactory;

    public $table = 'product_images';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'orientation',
        'path',
        'created_at',
        'updated_at',
        'product_id',

    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function product(){
        return $this->belongsTo('App\Models\Products','product_id','id');
    }
    public  function getOrientation(){

        if($this->orientation=='front')
            return 'أمام';
        if($this->orientation=='back')
            return 'خلف';
        if($this->orientation=='right')
            return 'يمين';
        if($this->orientation=='left')
            return 'يسار';


    }
}
