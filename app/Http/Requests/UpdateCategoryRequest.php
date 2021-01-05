<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'english_title' => ['required', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'title'=>'عنوان دسته',
            'english_title'=>'عنوان انگلیسی دسته'
        ];
    }
}
