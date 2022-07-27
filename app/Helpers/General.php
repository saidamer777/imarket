<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

function get_languages(){

  return \App\Models\Languages::active()->Selection()->get();
}

function get_default_lang(){

   return Config::get('app.locale');
}

function uploadImageToMainCategories($folder, $image)
{
   $file_extension = $image->getClientOriginalExtension();
   $file_name=time().'.'.$file_extension;
   $path=public_path().$folder;
   $image->move($path,$file_name);
   $image_path = 'public'.$folder.'\\'.$file_name;
   return $image_path;
}


function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}


function uploadVideo($folder, $video)
{
    $video->store('/', $folder);
    $filename = $video->hashName();
    $path = 'video/' . $folder . '/' . $filename;
    return $path;
}



