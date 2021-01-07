<?php


namespace App\Repositories;


use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function create(Request $request)
    {
        DB::transaction(function () use ($request) {
            $product = Product::create($request->except(['image', 'image_title']));

            $image = $this->uploadImage($request);
            $product->image()->create($image->all());
        });
    }

    public function update(Request $request, Model $product)
    {
        DB::transaction(function () use ($request, $product) {
            $product->update($request->except(['image', 'image_title']));

            if ($request->has('image')) {
                $image = $this->uploadImage($request);
                $product->image()->update($image->all());
            }
        });
    }
}
