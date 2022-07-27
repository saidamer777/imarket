<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    //
    public function create(){
    return view('admin.inventory.create');
    }
    public function products(){

        $allCategories = MainCategory::with('products')->get();
        return view('admin.inventory.products', compact('allCategories'));
    }
}
