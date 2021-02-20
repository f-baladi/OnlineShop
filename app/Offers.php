<?php
namespace App;
//use App\Jobs\IncredibleOffers;
use App\Models\Price;
use App\Models\Product;
use DB;
use Validator;
class Offers
{
    public function add($request,$product)
    {
        $Validator=Validator::make($request->all(),[
            'price1'=>'required|numeric',
            'price'=>'required|numeric',
            'product_number'=>'required|numeric',
            'max_number_order'=>'required|numeric',
            'date1'=>'required',
            'date2'=>'required'
        ],[],[
            'price1'=>'هزینه محصول',
            'price'=>'هزینه محصول برای فروش',
            'product_number'=>'تعداد موجودی محصول',
            'max_number_order'=>'تعداد قابل سفارش در سبد خرید',
            'date1'=>'تاریخ شروع',
            'date2'=>'تاریخ پایان',

        ]);
        if($Validator->fails())
        {
            return $Validator->errors();
        }
        else{
            $date1=$request->get('date1');
            $date2=$request->get('date2');
            $offers_first_time=getTimestamp($date1,'first');
            $offers_last_time=getTimestamp($date2,'last');


            $row=DB::table('old_prices')->where('product_id',$product->id)->first();
            if(!$row)
            {
                $this->addNewPriceRow($product,$request);
            }
            else
            {
                $this->updatePriceRow($row,$product,$request);
            }

            $product->offers_first_date=$date1;
            $product->offers_last_date=$date2;
            $product->offers_first_time=$offers_first_time;
            $product->offers_last_time=$offers_last_time;
            $product->offers=1;
            if($product->update($request->all()))
            {
//                $second=$offers_last_time-time()+1;
//                IncredibleOffers::dispatch($product->id)->delay(now()->addSecond($second));
                $this->priceUpdate($product);

                return 'ok';
            }
            else
            {
                return ['error'=>true];
            }
        }

    }
    public function addNewPriceRow($product,$request)
    {
        $n=$product->product_number-$request->get('product_number');
        if($n<0){
            $n=0;
        }
        $insert_id=DB::table('old_prices')
            ->insertGetId([
                'product_id'=>$product->id,
                'price'=>$product->price,
                'product_number'=>$n,
                'max_number_order'=>$product->max_number_order,
                'Number_product_sales'=>$request->get('product_number'),
            ]);
    }
    public function updatePriceRow($row,$product,$request)
    {
        $n=$row->product_number;
        if($row->Number_product_sales>$request->get('product_number'))
        {
            $n1=$row->Number_product_sales-$request->get('product_number');
            $n=$n+$n1;
        }
        else
        {
            $n1=$request->get('product_number')-$row->Number_product_sales;
            $n=$n-$n1;
        }
        DB::table('old_prices')->where(['product_id'=>$product->id])
            ->update([
                'Number_product_sales'=>$request->get('product_number'),
                'product_number'=>$n
            ]);
    }
    public function remove($product)
    {
        $old_prices=DB::table('old_prices')->where('product_id',$product->id)->first();
        if($old_prices)
        {
            $product->price=$old_prices->price;
            if($old_prices->product_number>0)
            {
                $product->product_number= $product->product_number+$old_prices->product_number;
            }
        }
        $product->offers_first_date=null;
        $product->offers_last_date=null;
        $product->offers_first_time=0;
        $product->offers_last_time=0;
        $product->offers=0;
        $product->update();
        DB::table('old_prices')->where('product_id',$product->id)->delete();

        $this->priceUpdate($product);

        return $product;
    }

    public function priceUpdate($price)
    {
        $product = Product::findOrFail($price->product_id);
        $newPrice = Price::where('product_id',$product->id)->orderBy('price')->first()->price;

        $product->update([
            'price' => $newPrice
        ]);
    }
}
