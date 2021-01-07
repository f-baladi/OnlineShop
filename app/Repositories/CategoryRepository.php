<?php


namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function create(Request $request)
    {
        DB::transaction(function () use ($request) {
            $category = $this->model->create($request->except(['image','image_title']));

            if ($request->has('image')) {
                $image = $this->uploadImage($request);
                $category->image()->Create($image->all());
            }
        });
    }

    public function update(Request $request, Model $category)
    {
        DB::transaction(function () use ($request, $category) {
            $category->update($request->except(['image','image_title']));

            if ($request->has('image')) {
                $image = $this->uploadImage($request);
                $category->image()->updateOrCreate($image->all());
            }
        });
    }
}
