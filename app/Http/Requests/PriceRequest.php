<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceRequest extends FormRequest
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
            'product_id'=>'required',
            'color_id'=>'required',
            'price'=>'required',
        ];
    }

    public function attributes()
    {
        return [
            'product_id'=>'محصول',
            'color_id'=>'رنگ',
            'price'=>'قیمت محصول',
            'product_number'=>'تعداد موجودی محصول',
            'max_number_order'=>'حداکثر سفارش در سبد خرید',
        ];
    }

    protected function getValidatorInstance()
    {
        if($this->request->has('price'))
        {
            $this->merge([
                'price'=>str_replace(',','',$this->request->get('price'))
            ]);
        }

        if($this->request->has('product_number'))
        {
            $this->merge([
                'product_number'=>str_replace(',','',$this->request->get('product_number'))
            ]);
        }

        if($this->request->has('max_number_order'))
        {
            $this->merge([
                'max_number_order'=>str_replace(',','',$this->request->get('max_number_order'))
            ]);
        }

        return parent::getValidatorInstance();
    }
}
