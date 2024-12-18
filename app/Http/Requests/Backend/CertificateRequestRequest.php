<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CertificateRequestRequest extends FormRequest
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


                        'full_name.ar'               =>      'required|max:255',
                        'date_of_birth'             =>      'nullable',

                        'nationality'               =>      'nullable',
                        'country'                   =>      'nullable',
                        'state'                     =>      'nullable',
                        'city'                      =>      'nullable',

                        'phone'                     =>      'required',
                        'whatsup_phone'             =>      'nullable',

                        'identity_type'             =>      'required',
                        'identity_number'           =>      'required',
                        'identity_expiration_date'  =>      'required',
                        'identity_attachment'        => 'nullable',


                        'certificate_name.ar'        =>      'nullable',
                        'certificate_code'          =>      'nullable',
                        'certificate_release_date'  =>      'nullable',
                        'certificate_file'          =>      'nullable',
                        'certificate_status'        =>      'nullable',

                        'sponser_id'                =>      'nullable',
                        'user_id'                   =>      'required',
                        'course_id'                 =>      'required',


                        // used always 
                        'status'                    =>  'required',
                        'published_on'              =>  'nullable',
                        'created_by'                =>  'nullable',
                        'updated_by'                =>  'nullable',
                        'deleted_by'                =>  'nullable',
                        // end of used always 

                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [

                        'full_name.ar'               =>      'required|max:255',
                        'date_of_birth'             =>      'nullable',

                        'nationality'               =>      'nullable',
                        'country'                   =>      'nullable',
                        'state'                     =>      'nullable',
                        'city'                      =>      'nullable',

                        'phone'                     =>      'required',
                        'whatsup_phone'             =>      'nullable',

                        'identity_type'             =>      'required',
                        'identity_number'           =>      'required',
                        'identity_expiration_date'  =>      'required',
                        'identity_attachment'        => 'nullable',


                        'certificate_name.ar'        =>      'nullable',
                        'certificate_code'          =>      'nullable',
                        'certificate_release_date'  =>      'nullable',
                        'certificate_file'          =>      'nullable',
                        'certificate_status'        =>      'nullable',

                        'sponser_id'                =>      'nullable',
                        'user_id'                   =>      'required',
                        'course_id'                 =>      'required',


                        // used always 
                        'status'                    =>  'required',
                        'published_on'              =>  'nullable',
                        'created_by'                =>  'nullable',
                        'updated_by'                =>  'nullable',
                        'deleted_by'                =>  'nullable',
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
            'phone'      => '( ' . __('panel.f_phone') . ' )',
            'status'    =>  '( ' . __('panel.status') . ' )',
        ];

        foreach (config('locales.languages') as $key => $val) {
            $attr += ['full_name.' . $key       =>  "( " . __('panel.full_name')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
        }


        return $attr;
    }
}
