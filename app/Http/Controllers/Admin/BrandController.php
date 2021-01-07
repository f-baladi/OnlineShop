<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected  $model='Brand';
    protected  $route='brands';
    protected  $title='برند';
    /**
     * @var BrandRepositoryInterface
     */
    private $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $result = $this->brandRepository->all($request);
        $brands = $result['models'];
        $trash_brand_count = $result['trash'];
        return view('admin.brand.index',compact('brands','trash_brand_count','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CreateBrandRequest $request)
    {
        $this->brandRepository->create($request);
        return redirect()->back()->with('message',__('public.success store',['name' => 'برند']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     */
    public function update(Request $request, Brand $brand)
    {
        $this->brandRepository->update($request,$brand);
        return redirect()->route('admin.brands.index')
            ->with('message',__('public.success edit',['name' => 'برند']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     */
    public function destroy(Brand $brand)
    {
        $this->brandRepository->delete($brand);
        return redirect()->route('admin.brands.index')
            ->with('message',__('public.success recycle bin',['name' => 'برند']));
    }
}
