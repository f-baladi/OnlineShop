<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryActionController extends Controller
{
    public function restore($id)
    {
        Category::withTrashed()->find($id)->restore();
        return redirect()->route('admin.categories.index')
            ->with('message',__('public.success restore',['name' => 'دسته']));
    }

    public function terminate($id)
    {
        Category::withTrashed()->find($id)->forceDelete();
        return redirect()->route('admin.categories.index')
            ->with('message',__('public.success delete',['name' => 'دسته']));
    }
}
