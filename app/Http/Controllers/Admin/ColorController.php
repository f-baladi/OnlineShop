<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use App\Repositories\Interfaces\ColorRepositoryInterface;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    protected  $model='Color';
    protected  $route='colors';
    protected  $title='رنگ';
    /**
     * @var ColorRepositoryInterface
     */
    private $colorRepository;

    public function __construct(ColorRepositoryInterface $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $result = $this->colorRepository->all($request);
        $colors = $result['models'];
        $trash_color_count = $result['trash'];
        return view('admin.color.index',compact('colors','trash_color_count','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.color.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(ColorRequest $request)
    {
        $this->colorRepository->create($request);
        return redirect()->back()->with('message',__('public.success store',['name' => 'رنگ']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $color
     */
    public function edit(Color $color)
    {
        return view('admin.color.edit',compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Color  $color
     */
    public function update(ColorRequest $request, Color $color)
    {
        $this->colorRepository->update($request,$color);
        return redirect()->route('admin.colors.index')
            ->with('message',__('public.success edit',['name' => 'رنگ']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     */
    public function destroy(Color $color)
    {
        $this->colorRepository->delete($color);
        return redirect()->route('admin.colors.index')
            ->with('message',__('public.success recycle bin',['name' => 'رنگ']));
    }
}
