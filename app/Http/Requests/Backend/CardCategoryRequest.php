<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CardCategoryRequest extends FormRequest
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
                    return [
                        'category_name.*' => 'required|max:255|unique_translation:product_categories',
                        'parent_id'     =>  'nullable',
                        'description.*'   =>  'required',
                        'images'        =>  'nullable',
                        'images.*'      =>  'mimes:jpg,jpeg,png,gif,webp|max:3000',
                        'views'         =>  'nullable',
                        'section'       =>  'nullable',
                        'featured'       =>  'required',


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
            case 'PUT':
            case 'PATCH': {
                    return [
                        'category_name.*' => 'required|max:255|unique_translation:product_categories,category_name,' . $this->route()->card_category,
                        'parent_id.*'     =>  'nullable',
                        'description'   =>  'required',
                        'images'        =>  'nullable',
                        'images.*'      =>  'mimes:jpg,jpeg,png,gif,webp|max:3000',
                        'views'         =>  'nullable',
                        'section'       =>  'nullable',
                        'featured'       =>  'required',

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

    public function attributes(): array
    {
        $attr = [
            'link'      => '( ' . __('panel.link') . ' )',
            'status'    =>  '( ' . __('panel.status') . ' )',
        ];

        foreach (config('locales.languages') as $key => $val) {
            $attr += ['category_name.' . $key       =>  "( " . __('panel.category_name')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
            $attr += ['description.' . $key       =>  "( " . __('panel.description')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
        }


        return $attr;
    }
}
