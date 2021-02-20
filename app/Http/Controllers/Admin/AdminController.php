<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Offers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.panel.index');
    }

    public function amazingOffers()
    {
        return view('admin.panel.amazingOffers');
    }

    public function getProduct(Request $request)
    {
        $search_text=$request->get('search_text','');
        $products = Price::with('color','product.image') ->orderBy('offers','DESC');

        if(!empty(trim($search_text)))
        {

            define('search_text',$search_text);
            $products=$products->whereHas('product',function (Builder $query){
                    $query->where('title','like','%'.search_text.'%');
                });
        }

        $products=$products->paginate(4);
        return $products;
    }

    public function add_amazingOffers($id,Request $request)
    {
        $product=Price::find($id);
        if($product){
            $offers=new Offers();
            $res=$offers->add($request,$product);
            return $res;
        }
        else{
            return 'error';
        }
    }

    public function remove_amazingOffers($id,Request $request)
    {
        $product=Price::find($id);
        if($product){
            $offers=new Offers();
            return $offers->remove($product);
        }
        else
        {
            return 'error';
        }
    }
}
