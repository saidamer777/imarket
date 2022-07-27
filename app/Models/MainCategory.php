<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;

    public $table = 'main_categories';
    public $timestamps = true;
    protected $fillable = [
        'translation_lang',
        'translation_of',
        'name',
        'slug',
        'image_path',
        'active',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [  'created_at',
        'updated_at',];


    public function scopeActive($query){
        return $query->where('active',1);
    }
    public  function scopeSelection($query){
        return $query->select('id','translation_lang','name','image_path','active');
    }
    public  function getActive(){
        return $this->active ==1 ? "مفعل":"غير مفعل";
    }

////////////////// Relations

    public function products(){
        return $this->hasMany('App\Models\Products','cat_id','id');
    }

    public function wholesales(){
        return $this->hasMany('App\Models\Wholesales','cat_id','id');
    }

    public function delete()
    {
        // delete all related images
        $this->products()->delete();
        $this->wholesales()->delete();
        // as suggested by Dirk in comment,
        // it's an uglier alternative, but faster
        // Photo::where("user_id", $this->id)->delete()

        // delete the user
        return parent::delete();
    }
}
