<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title','english_title','slug','parent_id'];

    public function setEnglishTitleAttribute($value)
    {
        $this->attributes['english_title'] = $value;
        $this->attributes['slug'] = str::slug(str::random(5) .'-'.$value);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getChild()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function getParent()
    {
        return $this->hasOne(Category::class,'id','parent_id')
            ->withTrashed()->withDefault(['title' => '*****']);
    }

    public static function get_parent()
    {
        $array=[0=>'دسته اصلی'];
        $lists=self::with('getChild.getChild')->where('parent_id',0)->get();
        foreach ($lists as $key=>$value)
        {
            $array[$value->id]=$value->title;
            foreach ($value->getChild as $key2=>$value2)
            {
                $array[$value2->id]=' - '.$value2->title;
                foreach ($value2->getChild as $key3=>$value3)
                {
                    $array[$value3->id]=' - - '.$value3->title;
                }
            }
        }
        return $array;
    }

    public static function get_parent2()
    {
        $array=[''=>'انتخاب دسته'];
        $list=self::with('getChild.getChild.getChild')->where('parent_id',0)->get();
        foreach ($list as $key=>$value)
        {
            $array[$value->id]=$value->title;
            foreach ($value->getChild as $key2=>$value2)
            {
                $array[$value2->id]=' - '.$value2->title;
                foreach ($value2->getChild as $key3=>$value3)
                {
                    $array[$value3->id]=' - - '.$value3->title;

                    foreach ($value3->getChild as $key4=>$value4)
                    {
                        $array[$value4->id]=' - - - '.$value4->title;
                    }
                }
            }
        }
        return $array;
    }

    public static function getData($request)
    {
        $string='?';
        $categories=self::with('getParent');;
        if(array_key_exists('trashed',$request) && $request['trashed']=='true')
        {
            $categories=$categories->onlyTrashed();
            $string=$string.'&trashed=true';

        }
        if (array_key_exists('string',$request) && !empty($request['string']))
        {
            $categories=$categories->where('title','like','%'.$request['string'].'%');
            $string=$string.'&string='.$request['string'];
        }
        $categories=$categories->paginate(10);
        $categories->withPath($string);
        return $categories;
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function($category){
            foreach ($category->getChild()->withTrashed()->get() as $cat)
            {
                if($category->isForceDeleting())
                {
                    $cat->forceDelete();
                }
                else{
                    $cat->delete();
                }
            }
        });

        static::restoring(function ($category){
            cache()->forget('catList');
            foreach ($category->getChild()->withTrashed()->get() as $cat)
            {
                $cat->restore();
            }
        });
    }
}
