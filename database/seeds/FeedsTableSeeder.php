<?php

use App\Feed;
use Illuminate\Database\Seeder;

class FeedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feed::create([
            'category_id' => '1',
            'url' => 'http://fullcontentrss.com/feed.php?url=https%3A%2F%2Fwww.techmeme.com%2Ffeed.xml&key=2&hash=345e3f27959f5d58e092203b511129531b664551&max=5&links=preserve'
        ]);

        Feed::create([
            'category_id' => '1',
            'url' => 'http://fullcontentrss.com/feed.php?url=https%3A%2F%2Ffeeds.feedburner.com%2FTechCrunch%3Fformat%3Dxml&key=2&hash=dc332a6b03eeca9cb615df08a5c30f23159b0548&max=10&links=preserve'
        ]);

        Feed::create([
            'category_id' => '1',
            'url' => 'http://fullcontentrss.com/feed.php?url=https%3A%2F%2Fwww.techmeme.com%2Ffeed.xml&key=2&hash=345e3f27959f5d58e092203b511129531b664551&max=10&links=preserve'
        ]);
        Feed::create([
            'category_id' => '1',
            'url' => 'http://fullcontentrss.com/feed.php?url=https%3A%2F%2Fwww.theverge.com%2Frss%2Ffrontpage&key=2&hash=956bc07abbbfa36624d97d03a0c6b944d8cc9528&max=10&links=preserve'
        ]);
    }
}
