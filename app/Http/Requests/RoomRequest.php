<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
        if(request()->isMethod('post')){
            return [
                'room_type_id' => 'required',
                'name' => 'required|string',
                'room_no' => 'required',
                'is_active' => 'required',
                'price' => 'nullable|numeric'
            ];
        } elseif(request()->isMethod('put') || request()->isMethod('patch')){
            return [
                'room_type_id' => 'required',
                'name' => 'required|string',
                'room_no' => 'required',
                'is_active' => 'required',
                'status' => 'required',
                'price' => 'nullable|numeric'
            ];
        }
        
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field is required',
            'room_no.required' => 'Enter room number',
            'is_active.required' => 'This field is required',
            'status.required' => 'Status is required',
            'room_type_id.required' => 'Room Type is required',
        ];
    }
}
