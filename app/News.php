<?php

namespace App;

use App\Gallery;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'body',
        'featured_image',
        'user_id'
    ];

    /**
     * This relationship return the auth user [author].
     * 
     * @return \App\User
     */
    public function author()
    {
		return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * This relationship return all images associated with this news.
     * 
     * @return \App\User
     */
    public function images()
    {
		return $this->hasMany(Gallery::class, 'news_id');
    }

    public function getImageFullPathAttribute()
    {
        return '/img/featured/' . $this->featured_image;
    }

    /**
     * @return string
     */
    public function getCreatedAtAttribute()
    {
        return  Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }
}
