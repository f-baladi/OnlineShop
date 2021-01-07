<?php


namespace App\Repositories;


use App\Models\Brand;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }

    public function create(Request $request)
    {
        $image = $this->uploadImage($request);
        $this->model->create([
            'name' => $request->name,
            'icon' => $image['path'],
        ]);
    }

    public function update(Request $request, Model $brand)
    {
        $brand->update([
            'name' => $request->name,
        ]);
        if ($request->has('image')) {
            $image = $this->uploadImage($request);
            $brand->update([
                'icon' => $image['path'],
            ]);
        }
    }
}
