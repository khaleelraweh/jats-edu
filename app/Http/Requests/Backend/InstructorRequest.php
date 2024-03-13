<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class InstructorRequest extends FormRequest
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
                        'name.*'               =>  'required|max:255|unique_translation:instructors',
                        'specialization.*'         =>  'nullable',
                        'email'                   =>  'nullable',
                        'phone'                =>  'required',

                        'images'                =>  'required',
                        'images.*'              =>  'mimes:jpg,jpeg,png,gif,webp|max:3000',

                        // used always 
                        'status'                =>  'required',
                        'published_on'          =>  'nullable',
                        'published_on_time'     =>  'nullable',
                        'created_by'            =>  'nullable',
                        'updated_by'            =>  'nullable',
                        'deleted_by'            =>  'nullable',
                        // end of used always 
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name.*'           =>  'required|max:255|unique_translation:sliders,title,' . $this->route()->main_slider,
                        'specialization.*'     =>  'nullable',
                        'email'               =>  'nullable',
                        'phone'            =>  'required',

                        'images'            =>  'nullable',
                        'images.*'          =>  'mimes:jpg,jpeg,png,gif,webp|max:3000',

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
            'email'      => '( ' . __('panel.email') . ' )',
            'phone'      => '( ' . __('panel.phone') . ' )',
            'status'    =>  '( ' . __('panel.status') . ' )',
        ];

        foreach (config('locales.languages') as $key => $val) {
            $attr += ['name.' . $key       =>  "( " . __('panel.name')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
            $attr += ['specialization.' . $key       =>  "( " . __('panel.specialization')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
        }

        return $attr;
    }
}
