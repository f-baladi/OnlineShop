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

    public function getChild()
    {
        return $this->hasMany(Category::class,'parent_id','id');
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
}
