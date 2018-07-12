<?php

namespace App\Console\Commands\UpdateFeed;

use App\Feed;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Facades\Validator;

class FeedUpdater
{
    /**
     * @var \App\Feed
     */
    protected $feeds;

    /**
     * @var \App\Feed
     */
    protected $currentFeed;

    /**
     * @var \Illuminate\Console\OutputStyle
     */
    protected $console;

    /**
     * FeedUpdater constructor.
     */
    public function __construct()
    {
        $this->feeds = Feed::all();
    }

    /**
     * Return feed object.
     *
     * @return \App\Feed
     */
    public function getFeeds()
    {
        return $this->feeds;
    }

    /**
     * Set current feed object.
     *
     * @param \App\Feed $feed
     */
    public function setCurrentFeed(Feed $feed)
    {
        $this->currentFeed = $feed;
    }

    /**
     * Save validated feed posts.
     *
     * @param \App\Console\Commands\UpdateFeed\FeedParser $parser
     */
    public function savePosts(FeedParser $parser)
    {
        foreach ($parser->getItems() as $data) {
            if ($this->validate($data)) {
                $this->createPost($data);
            }
        }
    }

    /**
     * Create and assign feed post to feed provider.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createPost(array $data)
    {

          return $this->currentFeed->feedPosts()->create([
            'title' => $data['title'],
            'text' => $data['text'],
            'url' => $data['url'],
            'pub_date' => $data['date']
        ]);
    }

    /**
     * Validate feed data.
     *
     * @param array $data
     * @return bool
     */
    public function validate(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|max:255',
            'text' => 'required',
            'url' => 'required|unique:feed_posts',
        ])->passes();
    }
}
