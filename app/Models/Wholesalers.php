<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Wholesalers extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table='wholesalers';
    protected $fillable = [
        'name',
        'phone',
        'password',
    ];
    protected $hidden=[

        'password',
        'created_at',
        'updated_at'

    ];

    public function favourites(){
        return $this->belongsToMany('App\Models\Wholesales','wholesales_favourites','wholesaler_id','wholesales_product_id');
    }

    public function marketplace(){
        return  $this->hasOne('App\Models\Marketplace','wholesaler_id','id');
    }

    public function bill(){
        return $this ->hasMany('App\Models\Wholesales_bills','wholesaler_id','id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
