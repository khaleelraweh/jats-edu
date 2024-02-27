<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CardCodeRequest extends FormRequest
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
                        'code'              =>  'required|max:255|unique:card_codes',
                        'code_type'         =>  'nullable',
                        'encoding_type'     =>  'nullable',
                        'product_id'        =>  'required',
                        'order_id'          =>  'nullable',


                        // used always 
                        'status'             =>  'nullable',
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
                        'code'                  => 'required|max:255|unique:card_codes,code,' . $this->route()->card_code->id,
                        'code_type'             =>  'nullable',
                        'encoding_type'         =>  'nullable',
                        'product_id'            =>  'required',
                        'order_id'              =>  'nullable',

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

            default:
                break;
        }
    }
}
