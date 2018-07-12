<?php

namespace Tests\Feature;

use App\Feed;
use App\Console\Commands\UpdateFeed\FeedUpdater;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FeedUpdaterTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test success of feed post creation.
     *
     * @return void
     */
    public function testFeedPostCreate()
    {
        $feed = Feed::create([
            'category_id' => '1',
            'url' => 'http://it.lrytas.lt/rss/'
        ]);

        $updater = new FeedUpdater();
        $data = [
            'title' => 'Feed post title',
            'text' => 'Some random feed post text',
            'url' => 'http://it.lrytas.lt/ismanyk/buvo-sutrikusi-socialinio-tinklo-facebook-veikla-20170113173711.htm',
            'date' => date('Y-m-d H:i:s', time())
        ];

        $updater->setCurrentFeed($feed);
        $post = $updater->createPost($data);

        $this->assertEquals('Feed post title', $post->title);
        $this->assertEquals('Some random feed post text', $post->text);
        $this->assertEquals('http://it.lrytas.lt/ismanyk/buvo-sutrikusi-socialinio-tinklo-facebook-veikla-20170113173711.htm', $post->url);
    }

    /**
     * Test success of feed post validation.
     *
     * @return void
     */
    public function testFeedPostValidate()
    {
        $updater = new FeedUpdater();
        $data = [
            'title' => 'Feed post title',
            'text' => 'Some random feed post text',
            'url' => 'http://it.lrytas.lt/rss/'
        ];

        $this->assertTrue($updater->validate($data));
    }

    /**
     * Test failure of feed post validation.
     *
     * @return void
     */
    public function testFeedPostValidateFail()
    {
        $updater = new FeedUpdater();
        $data = [
            'title' => 'Feed post title',
            'text' => 'Some random feed post text'
        ];

        $this->assertFalse($updater->validate($data));
    }
}
