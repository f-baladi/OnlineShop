<?php


namespace App\Repositories;


use App\Models\Slider;
use App\Repositories\Interfaces\SliderRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SliderRepository extends BaseRepository implements SliderRepositoryInterface
{
    public function __construct(Slider $model)
    {
        parent::__construct($model);
    }

    public function create(Request $request)
    {
        $image = $this->uploadImage($request);
        $this->model->create([
            'title' => $request->title,
            'image_url' => $image['path'],
        ]);
    }

    public function update(Request $request, Model $brand)
    {
        $brand->update([
            'title' => $request->title,
        ]);
        if ($request->has('image')) {
            $image = $this->uploadImage($request);
            $brand->update([
                'image_url' => $image['path'],
            ]);
        }
    }
}
