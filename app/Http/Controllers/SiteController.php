<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $categories = Category::with('getChild.getChild')
            ->where('parent_id',null)->get();
        $sliders=Slider::OrderBy('id','DESC')->get();
        return view('shop.index',compact('categories','sliders'));
    }
}
