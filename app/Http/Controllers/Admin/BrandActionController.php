<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandActionController extends Controller
{
    public function restore($id)
    {
        Brand::withTrashed()->find($id)->restore();
        return redirect()->route('admin.brands.index')
            ->with('message',__('public.success restore',['name' => 'برند']));
    }

    public function terminate($id)
    {
        Brand::withTrashed()->find($id)->forceDelete();
        return redirect()->route('admin.brands.index')
            ->with('message',__('public.success delete',['name' => 'برند']));
    }
}
