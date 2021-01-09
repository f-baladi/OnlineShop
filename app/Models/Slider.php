<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title','image_url'];

    public function getUrlAttribute()
    {
        return Storage::url($this->image_url);

    }

    public static function getData($request)
    {
        $string='?';
        $sliders=self::orderBy('id');
        if(array_key_exists('trashed',$request) && $request['trashed']=='true')
        {
            $sliders=$sliders->onlyTrashed();
            $string=$string.'&trashed=true';

        }
        if (array_key_exists('string',$request) && !empty($request['string']))
        {
            $sliders=$sliders->where('name','like','%'.$request['string'].'%');
            $string=$string.'&string='.$request['string'];
        }
        $sliders=$sliders->paginate(10);
        $sliders->withPath($string);
        return $sliders;
    }
}
