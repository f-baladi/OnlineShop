<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PriceRequest;
use App\Models\Color;
use App\Models\Price;
use App\Models\Product;
use App\Repositories\Interfaces\PriceRepositoryInterface;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class PriceController extends Controller
{
    protected  $model='Price';
    protected  $route='prices';
    protected  $title='قیمت محصول';

    private $priceRepository;

    public function __construct(PriceRepositoryInterface $priceRepository)
    {
        $this->priceRepository = $priceRepository;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     */
    public function index(Request $request)
    {
        $prices = $this->priceRepository->all($request);
        return view('admin.price.index',compact('prices','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $data = $this->priceRepository->dataPrepare();
        return view('admin.price.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(PriceRequest $request)
    {
        $result = $this->priceRepository->create($request);
        if ($result == true) {
            return redirect()->back()->with('message',__('public.success store',['name' => 'قیمت محصول']));
        }
        else
        return redirect()->back()->withInput()->with('danger','قیمت با مشخصات انتخابی قبلا ثبت شده است.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Price  $price
     */
    public function edit(Price $price)
    {
        $data = $this->priceRepository->dataPrepare();
        return view('admin.price.edit',compact('data','price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Price  $price
     */
    public function update(PriceRequest $request, Price $price)
    {
        $result = $this->priceRepository->update($request,$price);
        if ($result == true) {
            return redirect()->route('admin.prices.index')->with('success',__('public.success edit',['name' => 'قیمت محصول']));
        }
        else
            return redirect()->back()->withInput()->with('danger','قیمت با مشخصات انتخابی قبلا ثبت شده است.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Price  $price
     */
    public function destroy(Price $price)
    {
        $this->priceRepository->delete($price);
        return redirect()->route('admin.prices.index')
            ->with('success',__('public.success recycle bin',['name' => 'قیمت']));
    }
}
