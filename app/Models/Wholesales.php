<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wholesales extends Model
{
    use HasFactory;
    protected $table = 'wholesales_products';
    public $timestamps=true;
    protected $fillable = [
        'name',
        'price',
        'profit',
        'count',
        'active',
        'description',
        'total_price',
        'created_at',
        'updated_at',
        'cat_id'
    ];
    protected $hidden = [  'created_at',
        'updated_at','pivot'];

    public  function scopeSelection($query){
        return $query->select('id','name','price','count','profit','active');
    }
    public  function getActive(){
        return $this->active ==1 ? "مفعل":"غير مفعل";
    }

    public function category(){
        return $this->belongsTo('App\Models\MainCategory','cat_id','id');
    }
    public function Order(){
        return $this->belongsToMany('App\Models\Wholesales_bills','wholesales_products_orders','wholesale_product_id','wholesales_bill_id');
    }
    public function images(){
        return $this ->hasMany('App\Models\WholeSalesProductsImages','wholesale_product_id','id');
    }

    public function wholesaler(){
        return $this->belongsToMany('App\Models\Wholesalers','wholesales_favourites','wholesales_product_id','wholesaler_id');
    }


    public function delete()
    {
        // delete all related images
        $this->images()->delete();
        // as suggested by Dirk in comment,
        // it's an uglier alternative, but faster
        // Photo::where("user_id", $this->id)->delete()

        // delete the user
        return parent::delete();
    }


}
