<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Category;
use App\Image;
use App\Language;

class Post extends Model

{
    protected $guarded = [];
    protected $dates = ['published_at'];
    protected $fillable = ['published_at', 'category_id'];


    public function getPost($code)
    {
        $post = $this->languages()->where('code', $code)->first();
        return $post;


    }

    public function getTitleAttribute()
    {
        if ($this->languages()->where('code', \App::getLocale())->first())
        {
            return $this->languages()->where('code', \App::getLocale())->first()->pivot->title;
        }

        return " ";
    }

    public function getUrlAttribute()
    {
        if ($this->languages()->where('code', \App::getLocale())->first()) {

        return $this->languages()->where('code', \App::getLocale())->first()->pivot->url;

        }

        return " ";
    }

    public function getSubtitleAttribute()
    {
        if ($this->languages()->where('code', \App::getLocale())->first()) {

        return $this->languages()->where('code', \App::getLocale())->first()->pivot->subtitle;

        }

        return " ";
    }

    public function getExtractAttribute()
    {
        if ($this->languages()->where('code', \App::getLocale())->first()) {

        return $this->languages()->where('code', \App::getLocale())->first()->pivot->extract;

        }

        return " ";
    }

    public function getContentAttribute()
    {
        if ($this->languages()->where('code', \App::getLocale())->first()) {

        return $this->languages()->where('code', \App::getLocale())->first()->pivot->content;

        }

        return " ";
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /*public function getRouteKeyName()
    {
        return 'url';
    }*/

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function languages()
    {
        return $this->belongsToMany('App\Language', 'post_language')->withPivot('title', 'url', 'subtitle', 'extract', 'content', 'published_at', 'category_id');
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
