<?php

namespace App\Http\Controllers\Admin;


use App\Events\Confirmation;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\LangRequest;
use App\Models\Languages;
use App\Models\MainCategory;
use App\Models\Products;
use Illuminate\Http\Request;

class MainCategoriesController extends Controller
{
    public function getcategories()
    {
        $default_lang = get_default_lang();
        $maincats = MainCategory::where('translation_lang', $default_lang)->selection()->get();

        return view('admin.maincategories.index', compact('maincats'));
    }

    public function create()
    {
        return view('admin.maincategories.create');
    }


    public function store(CategoryRequest $request)
    {
        try {
        $main_category=new MainCategory();
        $main_category->translation_of = 1;
        $main_category->name = $request->name;
        $main_category->slug = $request->name;
        $main_category->translation_lang = $request->translation_lang;
        if (!$request->has('active')) {
            $main_category->active = 0;
        }
        else
            {
                $main_category->active = 1;
            }

        if($request->hasFile('image_path'))
        {
          $filepath = uploadImageToMainCategories('/asset/images/maincategories',$request->file('image_path'));
          $main_category->image_path=$filepath;

        }
        else{
            $main_category->image_path="";
        }
        $main_category->save();
        return redirect()->route('admin.maincategories')->with(['success' => 'تم حفظ القسم بنجاح']);
        } catch (\Exception $exception) {
            return redirect()->route('admin.maincategories')->with(['error' => 'هناك خطأ في حفظ القسم ']);

        }





//
//       if($request->has('path')){
//            $filepath = uploadImage('maincategories',$request->path);
//       }
//////
////            if ($request->hasFile('path')) {
////                  $filepath = uploadImageToMainCategories('/asset/images/maincategories', $request->path);
////            } else
////                return false;
//
//
//            if (!$request->has('active')) {
//                $request->request->add(['active' => 0]);
//            }
//            $request->request->add(['translation_of' => 1, 'slug' => $request->name, 'path' => $filepath]);
//
//             $cat->save();
//            return redirect()->route('admin.maincategories')->with(['success' => 'تم حفظ القسم بنجاح']);
//        } catch (\Exception $exception) {
//            return redirect()->route('admin.maincategories')->with(['error' => 'هناك خطأ في حفظ القسم ']);
//
//        }
    }

    public function edit($id)
    {
        $cat = MainCategory::select()->find($id);
        if (!$cat) {
            redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجودة']);
        }
        return view('admin.maincategories.edit', compact('cat'));
    }


    public function update(CategoryRequest $request, $id)
    {
//        return $request;

        try {
            $cat = MainCategory::find($id);
            if (!$cat) {
                return redirect()->route('admin.maincategories.edit', $id)->with(['error' => 'خطأ بتحديث معلومات القسم']);
            }
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);

            if($request->hasFile('image_path')) {
                if(file_exists($cat->image_path))
                {
                    \File::delete($cat->image_path);
                }
                $filepath = uploadImageToMainCategories('/asset/images/maincategories', $request->file('image_path'));



                ////update to DB
                $cat->update(['name' => $request->name,
                    'translation_lang' => $request->translation_lang,
                    'active' => $request->active,
                    'image_path' => $filepath
                ]);
                return redirect()->route('admin.maincategories')->with(['success' => 'تم التحديث بنجاح']);
            }
            else{

                $cat->update(['name' => $request->name,
                    'translation_lang' => $request->translation_lang,
                    'active' => $request->active,
                ]);
                return redirect()->route('admin.maincategories')->with(['success' => 'تم التحديث بنجاح']);
            }
        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'خطأ بتحديث معلومات القسم ']);
        }

    }

    public function delete($id)
    {
        try {
            $cat = MainCategory::find($id);
            if (!$cat) {
                return redirect()->route('admin.maincategories')->with(['error' => 'لا يوجد هذا القسم']);
            }
            ////update to DB
            $cat->delete();
            return redirect()->route('admin.maincategories')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'خطأ بعملية الحذف  ']);
        }
    }

    public function getextra(){
        $data=[];
         $cats=MainCategory::with(['products'=>function($query){
         return $query->select('cat_id','times')->get();
     }])->select('id','name')->get();


        foreach ($cats as $cat){
            $data[]=[
                'id'=>$cat->id,
                'name'=>$cat->name,
                'sum'=>$cat->products()->sum('times')
            ];
        }
        $data=collect($data)->sortByDesc('sum')->take(3);
        return view('admin.extra_main_categories.index',compact('data'));

    }



}

