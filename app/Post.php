<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'title','description','content','published_at','image','category_id','post_id'
    ];

    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('post_id','tag_id','created_at','updated_at');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearched($query)
    {
        $search = request()->query('search');

        if(!$search)
        {
            return $query;
        }
        else
        {
            return $query->where('title','LIKE',"%{$search}%");
        }
    }

}
