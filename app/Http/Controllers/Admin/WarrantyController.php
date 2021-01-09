<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WarrantyRequest;
use App\Models\Warranty;
use App\Repositories\Interfaces\WarrantyRepositoryInterface;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    protected  $model='Warranty';
    protected  $route='warranties';
    protected  $title='گارانتی';
    /**
     * @var WarrantyRepositoryInterface
     */
    private $warrantyRepository;

    public function __construct(WarrantyRepositoryInterface $warrantyRepository)
    {
        $this->warrantyRepository = $warrantyRepository;
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $warranties = $this->warrantyRepository->all($request);
        return view('admin.warranty.index',compact('warranties','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.warranty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(WarrantyRequest $request)
    {
        $this->warrantyRepository->create($request);
        return redirect()->back()->with('message',__('public.success store',['name' => 'گارانتی']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warranty  $warranty
     * @return \Illuminate\Http\Response
     */
    public function show(Warranty $warranty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warranty  $warranty
     */
    public function edit(Warranty $warranty)
    {
        return view('admin.warranty.edit',compact('warranty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warranty  $warranty
     */
    public function update(WarrantyRequest $request, Warranty $warranty)
    {
        $this->warrantyRepository->update($request,$warranty);
        return redirect()->route('admin.warranties.index')
            ->with('message',__('public.success edit',['name' => 'گارانتی']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warranty  $warranty
     */
    public function destroy(Warranty $warranty)
    {
        $this->warrantyRepository->delete($warranty);
        return redirect()->route('admin.warranties.index')
            ->with('message',__('public.success recycle bin',['name' => 'گارانتی']));
    }
}
