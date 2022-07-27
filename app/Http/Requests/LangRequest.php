<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'abbr'=>'required|string|max:10',
//            'active'=>'required|in:0,1',
            'direction'=>'required|in:ltr,rtl'

        ];
    }
    public function messages()
    {
        return [
            'name.required'=>' اسم اللغة مطلوب ',
            'abbr.required'=>'اختصار اللغة مطلوب ',
//            'active.required'=>'الحالة مطلوبة ',
            'name.string'=>'الاسم يجب ان يتكون من أحرف',
            'name.max'=>'الاسم يجب ان يتكون من 100 حرف على الأكثر ',
//            'active.in'=>'القيم المسموحة (0 , 1) ',
            'direction.in'=>'القيم المسموحة (ltr , rtl)'



        ];
    }
}
