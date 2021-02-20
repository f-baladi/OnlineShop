<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Price;
use App\Models\Slider;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $categories = Category::with('getChild.getChild')
            ->where('parent_id',null)->get();
        $sliders=Slider::OrderBy('id','DESC')->get();
        $amazingOffers = Price::with('product.image','oldPrice')->where(['offers'=>1])->get();
//        dd($amazingOffers->all());
        return view('shop.index',compact('categories','sliders','amazingOffers'));
    }
}
