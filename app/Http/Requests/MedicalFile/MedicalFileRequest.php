<?php

namespace App\Http\Requests\MedicalFile;

use Illuminate\Foundation\Http\FormRequest;

class MedicalFileRequest extends FormRequest
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
            'customer_id'  =>'required',
            'file_number'  =>'required',
            'file_date'    =>'required',
            'review_date'  =>'required',
            'PDF'          =>'required',
            'doctor_id'    =>'required',
            'is_active'    =>'required|in:0,1',
            'is_approved'  =>'required|in:0,1',
        ];
    }

    public function messages()
    {
        return[
            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',
        ];
    }
}
