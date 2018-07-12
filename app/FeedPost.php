<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedPost extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['feed_id', 'title', 'text', 'url', 'pub_date'];

    /**
     * Feed post belongs to feed.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }
}
