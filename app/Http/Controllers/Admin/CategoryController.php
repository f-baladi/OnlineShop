<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected  $model = 'Category';
    protected  $route = 'categories';
    protected  $title = 'دسته';
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $categories = Category::getData($request->all());
        $trash_cat_count = Category::onlyTrashed()->count();
        return view('admin.category.index',compact('categories','trash_cat_count','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $parent_cat=Category::get_parent();
        return view('admin.category.create',compact('parent_cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CreateCategoryRequest $request)
    {
        DB::transaction(function () use ($request) {
            $category = Category::create($request->except(['image','image_title']));

            if ($request->has('image')) {
                $fileName = str::random(5) .' '. $request->image_title;
                $path = $request->file('image')->storePublicly('images');

                $category->image()->create([
                    'title' => $fileName,
                    'path' => $path,
                ]);
            }
        });

        return redirect()->route('admin.categories.create')
            ->with('message',__('public.success store',['name' => 'دسته']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     */
    public function edit(category $category)
    {
        $parent_cat=Category::get_parent();
        return view('admin.category.edit',compact('category','parent_cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     */
    public function update(UpdateCategoryRequest $request, category $category)
    {
        DB::transaction(function () use ($request, $category) {
            $category->update($request->except(['image','image_title']));

            if ($request->has('image')) {
                $fileName = str::random(5) .' '. $request->image_title;
                $path = $request->file('image')->storePublicly('images');

                $category->image()->update([
                    'title' => $fileName,
                    'path' => $path,
                ]);
            }
        });

        return redirect()->route('admin.categories.index')
            ->with('message',__('public.success edit',['name' => 'دسته']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     */
    public function destroy(category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')
            ->with('message',__('public.success recycle bin',['name' => 'دسته']));
    }
}
