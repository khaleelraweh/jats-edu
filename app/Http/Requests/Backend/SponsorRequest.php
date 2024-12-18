<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SponsorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'name.*'            =>  'required|max:255',
                        'address.*'         =>  'nullable',

                        'phone'             =>  'nullable',
                        'email'             =>  'nullable',
                        'pox'               =>  'nullable',
                        'website'           =>  'nullable',
                        'views'             =>  'nullable',
                        'coordinator_name.*' =>  'nullable',
                        'coordinator_phone' =>  'nullable',
                        'coordinator_email' =>  'nullable',
                        'logo'              => 'nullable|mimes:jpg,jpeg,png,svg,gif,webp|max:3000',


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
                        'name.*'            =>   'required|max:255',
                        'address.*'         =>   'nullable',

                        'phone'             =>  'nullable',
                        'email'             =>  'nullable',
                        'pox'               =>  'nullable',
                        'website'           =>  'nullable',
                        'views'             =>  'nullable',
                        'coordinator_name.*' =>  'nullable',
                        'coordinator_phone' =>  'nullable',
                        'coordinator_email' =>  'nullable',

                        'logo'              => 'nullable|mimes:jpg,jpeg,png,svg,gif,webp|max:3000',


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
            'status'    =>  '( ' . __('panel.status') . ' )',
            'logo'    =>  '( ' . __('panel.sponsor_logo') . ' )',
        ];

        foreach (config('locales.languages') as $key => $val) {
            $attr += ['name.' . $key       =>  "( " . __('panel.sponsor_name')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
        }


        return $attr;
    }
}
