<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class ServicesRequest extends FormRequest
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
            // 'name' => 'required|unique:services|max:100|min:8',
            'name' =>[
                'required',
                'max:100',
                'min:8',
                Rule::unique('services')->ignore($this->id),
            ],
            'icon' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Hãy nhập tên.',
            'name.unique' => 'Tên đã tồn tại.',
            'name.max' => 'Tên quá dài.',
            'name.min' => 'Tên quá ngắn.',
            'icon.required' => 'Bạn cần chọn ảnh.',
        ];
    }
}
