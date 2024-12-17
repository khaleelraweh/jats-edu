<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CertificateRequest extends FormRequest
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
                        'full_name.ar'          =>  'required|max:255',
                        'cert_code'             =>  'required',
                        'user_id'               =>  'nullable',
                        'course_id'             =>  'nullable',

                        // used always 
                        'status'                =>  'required',
                        'date_of_issue'         =>  'nullable',
                        'published_on'          =>  'nullable',
                        'created_by'            =>  'nullable',
                        'updated_by'            =>  'nullable',
                        'deleted_by'            =>  'nullable',
                        // end of used always 

                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'full_name.ar'          =>  'required|max:255',
                        'cert_code'             =>  'required',
                        'user_id'               =>  'nullable',
                        'course_id'             =>  'nullable',

                        // used always 
                        'status'                =>  'required',
                        'date_of_issue'         =>  'nullable',
                        'published_on'          =>  'nullable',
                        'created_by'            =>  'nullable',
                        'updated_by'            =>  'nullable',
                        'deleted_by'            =>  'nullable',
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
            'content'      => '( ' . __('panel.f_content') . ' )',
            'status'    =>  '( ' . __('panel.status') . ' )',
        ];

        foreach (config('locales.languages') as $key => $val) {
            $attr += ['title.' . $key       =>  "( " . __('panel.title')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
        }


        return $attr;
    }
}
