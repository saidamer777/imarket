<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LangRequest;
use App\Models\Languages;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    public  function getLanguages(){
        $languages= Languages::select()->paginate(10);
       return view('admin.languages.index',compact('languages'));
    }
     public  function create(){
        return view('admin.languages.create');
    }


    public  function store(LangRequest $request){
        try {
            if(!$request->has('active'))
            {
                $request ->request->add(['active'=>0]);
            }
                 Languages::create($request->except(['_token']));
                 return redirect()->route('admin.languages')->with(['success'=>'تم حفظ اللغة بنجاح']);
        }catch (\Exception $exception){
            return redirect()->route('admin.languages')->with(['error'=>'هناك خطأ في حفظ اللغة ']);

        }

//
    }

    public function edit($id){
    $language=Languages::select()->find($id);
    if(!$language)
    {
        redirect()->route('admin.languages')->with(['error'=>'هذه اللغة غير موجودة']);
    }
        return view('admin.languages.edit',compact('language'));
    }
    public function update($id,LangRequest $request){
        try {
            $language= Languages::find($id);
            if(!$language)
            {
                return redirect()->route('admin.language.edit',$id)->with(['error'=>'خطأ بتحديث اللغة']);
            }
            if(!$request ->has('active'))
                $request ->request->add(['active'=>0]);
            ////update to DB
            $language ->update($request->except('_token'));
            return redirect()->route('admin.languages')->with(['success'=>'تم التحديث بنجاح']);

        }catch (\Exception $ex)
        {
            return redirect()->route('admin.languages')->with(['error'=>'خطأ بتحديث اللغة ']);
        }

    }
    public function delete($id){
        try {
            $language= Languages::find($id);
            if(!$language)
            {
                return redirect()->route('admin.languages')->with(['error'=>'خطأ بتحديث اللغة']);
            }
            ////update to DB
            $language ->delete();
            return redirect()->route('admin.languages')->with(['success'=>'تم الحذف بنجاح']);

        }catch (\Exception $ex)
        {
            return redirect()->route('admin.languages')->with(['error'=>'خطأ بتحديث اللغة ']);
        }
    }


}
