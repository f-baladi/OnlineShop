<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['name'];

    public static function getData($request)
    {
        if(array_key_exists('trashed',$request) && $request['trashed']=='true')
        {
            if(array_key_exists('string',$request) && !empty($request['string']))
            {
                $brands=Brand::onlyTrashed()
                    ->where('title','like','%'.$request['string'].'%')->paginate(10);
            }
            else
                $brands=Brand::onlyTrashed()->paginate(10);
        }
        elseif (array_key_exists('string',$request) && !empty($request['string']))
        {
            $brands=Brand::where('name','like','%'.$request['string'].'%')->paginate(10);
        }
        else
            $brands = Brand::paginate(10);
        return $brands;
    }
}
