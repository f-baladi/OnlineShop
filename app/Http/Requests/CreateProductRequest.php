<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'title'=>['required',],
            'english_title'=>['required','unique:products,english_title'],
            'image_title'=>['required'],
            'category_id'=>['required'],
            'image'=>['required','image'],
            'brand_id'=>['required'],
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'عنوان محصول',
            'english_title' => 'عنوان انگلیسی محصول',
            'image_title' => 'عنوان تصویر',
            'category_id' => 'دسته محصول',
            'brand_id' => 'برند محصول',
            'description' => 'توضیحات',
        ];
    }
}
