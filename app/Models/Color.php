<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','code'];

    public static function getData($request)
    {
        $string='?';
        $colors=self::orderBy('id');
        if(array_key_exists('trashed',$request) && $request['trashed']=='true')
        {
            $colors=$colors->onlyTrashed();
            $string=$string.'&trashed=true';

        }
        if (array_key_exists('string',$request) && !empty($request['string']))
        {
            $colors=$colors->where('name','like','%'.$request['string'].'%');
            $string=$string.'&string='.$request['string'];
        }
        $colors=$colors->paginate(10);
        $colors->withPath($string);
        return $colors;
    }
}
