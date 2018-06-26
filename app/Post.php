<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Category;

class Post extends Model


{
    protected $guarded = [];
    protected $dates = ['published_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

     public function scopePublished($query)
    {
        $query->whereNotNull('published_at')
                ->where('published_at', '<=', Carbon::now() )
                ->latest('published_at');
    }

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['url'] = str_slug($title);
    }
}
