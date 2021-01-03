<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function restore($id)
    {
        $model_name="App\\Models\\".$this->model;
        $model_name::withTrashed()->find($id)->restore();
        return redirect()->route('admin.'.$this->route.'.index')
            ->with('message',__('public.success restore',['name' => $this->title]));
    }

    public function terminate($id)
    {
        $model_name="App\\Models\\".$this->model;
        $model_name::withTrashed()->find($id)->forceDelete();
        return redirect()->back()
            ->with('message',__('public.success delete',['name' => $this->title]));
    }
}
