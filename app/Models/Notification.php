<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $table = 'notifications';
    public $timestamps = true;
    protected $fillable = [
       'id',
       'bill_id','confirmed','created_at','updated_at'
    ];
    public function order(){
        $this->belongsTo('App\Models\Bills','bill_id','id');
    }


}
