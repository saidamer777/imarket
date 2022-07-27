<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'customers';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
        'phone_number',
        'verification_code',
        'vip',
        'active',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [  'created_at',
        'updated_at',];


    public function address(){
      return  $this->hasMany('App\Models\Address','customer_id','id');
    }

    public function bill(){
       return $this ->hasMany('App\Models\Bills','customer_id','id');
    }


    public function delete()
    {
        // delete all related images
        $this->address()->delete();
        // as suggested by Dirk in comment,
        // it's an uglier alternative, but faster
        // Photo::where("user_id", $this->id)->delete()

        // delete the user
        return parent::delete();
    }

    public function favourites(){
        return $this->belongsToMany('App\Models\Products','customer_favourites','customer_id','product_id');
    }
    public  function getActive(){
        return $this->active=='1' ? "مفعل":"غير مفعل";
    }


}
