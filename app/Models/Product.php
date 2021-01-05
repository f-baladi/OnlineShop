<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function setEnglishTitleAttribute($value)
    {
        $this->attributes['english_title'] = $value;
        $this->attributes['slug'] = str::slug($value);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public static function getData($request)
    {
        $string='?';
        $products=self::orderBy('id');
        if(array_key_exists('trashed',$request) && $request['trashed']=='true')
        {
            $products=$products->onlyTrashed();
            $string=$string.'&trashed=true';

        }
        if (array_key_exists('string',$request) && !empty($request['string']))
        {
            $products=$products->where('name','like','%'.$request['string'].'%');
            $string=$string.'&string='.$request['string'];
        }
        $products=$products->with('image')->paginate(10);
        $products->withPath($string);
        return $products;
    }

}
