<?php


namespace App\Repositories;


use App\Models\Color;
use App\Models\Price;
use App\Models\Product;
use App\Repositories\Interfaces\PriceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PriceRepository extends BaseRepository implements PriceRepositoryInterface
{
    public function __construct(Price $model)
    {
        parent::__construct($model);
    }

    public function dataPrepare()
    {
        $product[''] = 'انتخاب محصول';
        $products = $product + Product::pluck('title', 'id')->toArray();
        $color[''] = 'انتخاب رنگ';
        $colors = $color + Color::pluck('name', 'id')->toArray();
        return collect(['products' => $products, 'colors' => $colors]);

    }

    public function create(Request $request)
    {
        $check = $this->check($request);

        if(!$check)
        {
            DB::transaction(function () use ($request) {
                Price::create($request->all());
                $this->priceUpdate($request);
            });
            return true;
        }
        else{
            return false;
        }

    }

    public function update(Request $request, Model $price)
    {
        $check = $this->check($request);

        if(!$check)
        {
            DB::transaction(function () use ($price, $request) {
                $price->update($request->all());
                $this->priceUpdate($request);
            });
            return true;
        }
        else{
            return false;
        }
    }

    public function delete(Model $price)
    {
        $product = $price->product;
        $request = collect('product_id')->combine("$product->id");
        $price->delete();
        $this->priceUpdate($request);
    }

    public function priceUpdate($request)
    {
        $product = Product::findOrFail($request['product_id']);
        $newPrice = Price::where('product_id',$product->id)->orderBy('price')->first()->price;

            $product->update([
                'price' => $newPrice
            ]);
    }

    public function check(Request $request)
    {
        $check=Price::where([
            'color_id'=>$request->get('color_id'),
            'product_id'=>$request->get('product_id'),
            'price'=>$request->get('price'),
        ])->first();
        return $check;
    }
}
