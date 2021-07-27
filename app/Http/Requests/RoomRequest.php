<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return [
            'room_no' =>[
                'required',
                'max:50',
                'min:3',
                Rule::unique('rooms')->ignore($this->id),
            ],
            'floor' => 'required',
            'image' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'room_no.required' => 'Hãy nhập tên.',
            'room_no.unique' => 'Tên đã tồn tại.',
            'room_no.max' => 'Tên quá dài.',
            'room_no.min' => 'Tên quá ngắn.',
            'floor.required' => 'Bạn cần nhập số tầng.',
            'image.required' => 'Bạn cần chọn ảnh.',
            'price.required' => 'Bạn nhập giá.',
        ];
    }


}
