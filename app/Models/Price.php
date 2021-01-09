<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Price extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['product_id','color_id','warranty_id','price','product_number','max_number_order'];

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getData($request)
    {
        $string='?';
        $prices=self::orderBy('product_id');
        if(array_key_exists('trashed',$request) && $request['trashed']=='true')
        {
            $prices=$prices->onlyTrashed();
            $string=$string.'&trashed=true';

        }
        $prices=$prices->with('color','product')->paginate(10);
        $prices->withPath($string);
        return $prices;
    }
}
