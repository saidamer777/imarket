<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WholeSalesProductsImages extends Model
{
    use HasFactory;
    use HasFactory;

    public $table = 'wholesales_products_images';
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


    public function wholesalesproduct(){
        return $this->belongsTo('App\Models\Wholesales','wholesale_product_id','id');
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
