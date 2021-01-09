<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use App\Repositories\Interfaces\SliderRepositoryInterface;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected  $model='Slider';
    protected  $route='sliders';
    protected  $title='اسلایدر';
    /**
     * @var SliderRepositoryInterface
     */
    private $sliderRepository;

    public function __construct(SliderRepositoryInterface $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $sliders = $this->sliderRepository->all($request);
        return view('admin.slider.index',compact('sliders','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CreateSliderRequest $request)
    {
        $this->sliderRepository->create($request);
        return redirect()->back()->with('success',__('public.success store',['name' => 'اسلایدر']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     */
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $this->sliderRepository->update($request,$slider);
        return redirect()->route('admin.sliders.index')
            ->with('message',__('public.success edit',['name' => 'اسلایدر']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     */
    public function destroy(Slider $slider)
    {
        $this->sliderRepository->delete($slider);
        return redirect()->route('admin.sliders.index')
            ->with('message',__('public.success recycle bin',['name' => 'اسلایدر']));
    }
}
