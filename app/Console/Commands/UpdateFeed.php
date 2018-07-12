<?php

namespace App\Console\Commands;

use App\Console\Commands\UpdateFeed\FeedParser;
use App\Console\Commands\UpdateFeed\FeedUpdater;
use Illuminate\Console\Command;

class UpdateFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates feed posts from all feeds';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $updater = new FeedUpdater();

        $bar = $this->output->createProgressBar(count($updater->getFeeds()));

        foreach ($updater->getFeeds() as $feed) {
            $updater->setCurrentFeed($feed);

            try {
                $updater->savePosts(new FeedParser($feed->url));
            } catch (\Exception $e) {
                continue;
            }

            $bar->advance();
        }

        $bar->finish();
    }
}
