<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected  $model='Product';
    protected  $route='products';
    protected  $title='محصول';

    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $result = $this->productRepository->all($request);
        $products = $result['models'];
        $trash_product_count = $result['trash'];
        return view('admin.product.index',compact('products','trash_product_count','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $brand['']='انتخاب برند';
        $brands=$brand+Brand::pluck('name','id')->toArray();
        $categories=Category::get_parent2();

        return view('admin.product.create',compact('brands','categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CreateProductRequest $request)
    {
        $this->productRepository->create($request);
        return redirect()->back()->with('message',__('public.success store',['name' => 'محصول']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     */
    public function edit(Product $product)
    {
        $brand['']='انتخاب برند';
        $brands=$brand+Brand::pluck('name','id')->toArray();
        $categories=Category::get_parent2();

        return view('admin.product.edit',compact('brands','categories','product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     */
    public function update(Request $request, Product $product)
    {
        $this->productRepository->update($request,$product);
        return redirect()->route('admin.products.index')
            ->with('message',__('public.success edit',['name' => 'محصول']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     */
    public function destroy(Product $product)
    {
        $this->productRepository->delete($product);
        return redirect()->route('admin.products.index')
            ->with('message',__('public.success recycle bin',['name' => 'محصول']));
    }
}
