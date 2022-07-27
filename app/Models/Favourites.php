<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourites extends Model
{
    use HasFactory;

    protected $table='favourites';
    public $timestamps= true;


    public function customer(){
        $this->belongsTo('App\Models\Customer','customer_id','id');
    }

    public function products(){
        $this->belongsToMany('App\Models\Products','fav_products','fav_id','product_id');
    }
}
