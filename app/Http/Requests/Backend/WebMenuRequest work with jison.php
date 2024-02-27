<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class WebMenuRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                    $attr =  [
                        'title.*'       =>  'required|max:255|unique_translation:web_menus',
                        'link'          =>  'required',
                        'parent_id'     =>  'nullable',
                        'section'       =>  'nullable',
                        // $this->all('title'),

                        // used always 
                        'status'             =>  'required',
                        'published_on'       =>  'nullable',
                        'published_on_time'  =>  'nullable',
                        'created_by'         =>  'nullable',
                        'updated_by'         =>  'nullable',
                        'deleted_by'         =>  'nullable',
                        // end of used always 

                    ];

                    //كود شغال 
                    // foreach (config('locales.languages') as $key => $val) {
                    //     $attr += ['title.' . $key       =>  'required|max:255',];
                    // }

                    // كود شغال
                    // شغال للتاكد من ان القيمة المدخلة لا يوجد هناك نفسها في نفس اللغة مثلا في اللغة العربية في الجدول 
                    // foreach (config('locales.languages') as $key => $val) {
                    //     $attr += ['title.' . $key       =>  'required|max:255|unique_translation:web_menus',];
                    // }

                    // كود شغال
                    // شغال لجعل هذه الشروط تطبق علي كافة الترجمات التابعة للستايل نفس السابق دو الحاجة للفور
                    // $attr += ['title.*'       =>  'required|max:255|unique_translation:web_menus',];



                    return $attr;
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        // 'title'             =>   'required|max:255|unique:web_menus,name_ar,' . $this->route()->web_menu->id,
                        // 'slug.*' => "unique_translation:posts,slug,{$post->id}",
                        // 'title.*'             =>   'required|max:255|unique_translation:web_menus,title,' . $this->route()->id,
                        'title.*'       =>  'required|max:255|unique_translation:web_menus',

                        'link'              =>   'required',
                        'parent_id'         =>   'nullable',
                        'section'           =>   'nullable',

                        // used always 
                        'status'             =>  'required',
                        'published_on'       =>  'nullable',
                        'published_on_time'  =>  'nullable',
                        'created_by'         =>  'nullable',
                        'updated_by'         =>  'nullable',
                        'deleted_by'         =>  'nullable',
                        // end of used always 

                    ];
                }

            default:
                break;
        }
    }



    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        $attr = [
            'link'      => '( ' . __('panel.link') . ' )',
            'status'    =>  '( ' . __('panel.status') . ' )',
        ];

        foreach (config('locales.languages') as $key => $val) {
            $attr += ['title.' . $key       =>  "( " . __('panel.title')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
        }


        return $attr;
    }


    // public function messages()
    // {
    //     // use trans instead on Lang 
    //     return [
    //         //   'username.required' => Lang::get('userpasschange.usernamerequired'),
    //         'link.required' => __('panel.link'),

    //     ];
    // }
}
