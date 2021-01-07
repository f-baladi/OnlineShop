<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warranty extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public static function getData($request)
    {
        $string='?';
        $warranties=self::orderBy('id');
        if(array_key_exists('trashed',$request) && $request['trashed']=='true')
        {
            $warranties=$warranties->onlyTrashed();
            $string=$string.'&trashed=true';

        }
        if (array_key_exists('string',$request) && !empty($request['string']))
        {
            $warranties=$warranties->where('name','like','%'.$request['string'].'%');
            $string=$string.'&string='.$request['string'];
        }
        $warranties=$warranties->paginate(10);
        $warranties->withPath($string);
        return $warranties;
    }
}
