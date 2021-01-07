<?php


namespace App\Repositories;

use \App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Collection;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(Request $request)
    {
        $models = $this->model->getData($request->all());
        $trash_model_count = $this->model->onlyTrashed()->count();
        return collect(['models'=>$models,'trash'=>$trash_model_count]);

    }

    public function create(Request $request)
    {
        return $this->model->create($request->all());
    }

    public function update(Request $request , Model $model)
    {
        return $model->update($request->all());
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }

    public function uploadImage(Request $request)
    {
        $fileName = str::random(5) .' '. $request->image_title;
        $path = $request->file('image')->storePublicly('images');

        return collect(['title'=>$fileName, 'path'=>$path]);
    }
}
