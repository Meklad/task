<?php

namespace App;

use App\News;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
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
     * This relationship return the news that belongs to this image.
     * 
     * @return \App\User
     */
    public function news()
    {
		return $this->belongsTo(News::class, 'news_id');
    }
}
