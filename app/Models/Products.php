<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    public $timestamps=true;
    protected $fillable = [
        'id',
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
        return $this->belongsToMany('App\Models\Bills','products_bills','product_id','bill_id')->withPivot('products_count');
    }
    public function favourites(){
        $this->belongsToMany('App\Models\Products','fav_products','product_id','fav_id');

    }
    public function images(){
        return $this ->hasMany('App\Models\Product_images','product_id','id');
    }

    public function customer(){
        return $this->belongsToMany('App\Models\Customer','customer_favourites','product_id','customer_id');
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
