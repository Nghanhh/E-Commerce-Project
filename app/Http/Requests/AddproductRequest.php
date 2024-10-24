<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddproductRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'        => 'required',
            'price'       => 'required',
            'id_category' => 'required',
            'id_brand'    => 'required',
            'company'     => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'image.*'     => 'required|image|mimes:jpeg,png,jpg,gif|max:1024', // Kích thước tối đa 1MB (1024KB)
            'detail'      => 'required',
        ];
    }
}
