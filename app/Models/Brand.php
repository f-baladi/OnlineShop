<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function getData($request)
    {
        $string='?';
        $brands=self::orderBy('id');
        if(array_key_exists('trashed',$request) && $request['trashed']=='true')
        {
                $brands=$brands->onlyTrashed();
                $string=$string.'&trashed=true';

        }
        if (array_key_exists('string',$request) && !empty($request['string']))
        {
            $brands=$brands->where('name','like','%'.$request['string'].'%');
            $string=$string.'&string='.$request['string'];
        }
        $brands=$brands->paginate(10);
        $brands->withPath($string);
        return $brands;
    }
}
