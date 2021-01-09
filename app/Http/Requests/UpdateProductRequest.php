<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'title'=>['required',Rule::unique('products')->ignore($this->title,'title')],
            'english_title'=>['required',Rule::unique('products')->ignore($this->english_title,'english_title')],
            'image_title'=>['required'],
            'category_id'=>['required'],
            'image'=>['required','image'],
            'brand_id'=>['required'],
            'status'=>['required'],
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
            'status' => 'وضعیت',
        ];
    }
}
