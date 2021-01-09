<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use function GuzzleHttp\Promise\all;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function restore($id)
    {
        $model_name="App\\Models\\".$this->model;
        if ($model_name == "App\\Models\\Price") {
            $price = $model_name::withTrashed()->findOrFail($id);
            $product = Product::findOrFail($price->product_id);

            if($product->price > $price->price){
                $product->update([
                    'price' => $price->price
                ]);
            }
            $price->restore();
            return redirect()->route('admin.'.$this->route.'.index')
            ->with('message',__('public.success restore',['name' => $this->title]));
        }
        else{
            $model_name::withTrashed()->findOrFail($id)->restore();

            return redirect()->route('admin.'.$this->route.'.index')
                ->with('message',__('public.success restore',['name' => $this->title]));
        }
    }

    public function terminate($id)
    {
        $model_name="App\\Models\\".$this->model;
        $model_name::withTrashed()->findOrFail($id);
        return redirect()->back()
            ->with('success',__('public.success delete',['name' => $this->title]));
    }
}
