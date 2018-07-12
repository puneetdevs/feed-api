<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id', 'url'];

    /**
     * Feed belongs to category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Feed has many posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedPosts()
    {
        return $this->hasMany(FeedPost::class);
    }
}
