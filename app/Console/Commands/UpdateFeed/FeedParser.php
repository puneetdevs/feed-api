<?php

namespace App\Console\Commands\UpdateFeed;

use Storage;

class FeedParser
{
    /**
     * @var \SimpleXMLElement
     */
    protected $feed;

    /**
     * FeedParser constructor.
     *
     * @param string $feed
     */
    public function __construct($feed)
    {
        $this->feed = new \SimpleXMLElement($feed, LIBXML_NOCDATA, true);
    }

    /**
     * Returns feed object.
     *
     * @return \SimpleXMLElement
     */
    public function getFeed()
    {
        return $this->feed;
    }

    /**
     * Get all items from XML.
     *
     * @return array
     */
    public function getItems()
    {
        $items = [];
        foreach ($this->feed->channel->item as $item) {
            if (strpos($item->description, '<IMG') !== false || strpos($item->description, '<img') !== false) {
                $item->description = $this->storeImageAndReplacePath($item->description);
            }
            $items[] = $this->getItemData($item);
        }

        return $items;
    }

    /**
     * Get needed item data from XML.
     *
     * @param $item
     * @return array
     */
    protected function getItemData($item)
    {
        $title = $item->title;
        $text = $item->description;
        $url = $item->guid;

        $pubDate = strtotime($item->pubDate);
        $date = date('Y-m-d H:i:s', ($pubDate ? $pubDate : time()));

        return compact('title', 'text', 'url', 'date');
    }

    /**
     * Function for store image local and replace image url
     * @param $description
     * @return mixed
     */
    function storeImageAndReplacePath($description)
    {
        preg_match_all('@src="([^"]+)"@', $description, $images);
        if (count($images) > 1) {
            $images = $images[1];
            foreach ($images as $image_url) {
                $contents = file_get_contents($image_url);
                $extension = pathinfo(parse_url($image_url, PHP_URL_PATH), PATHINFO_EXTENSION);
                if ($extension) {
                    $name = time() . '.' . $extension;
                } else {
                    $name = time() . substr($image_url, strrpos($image_url, '/') + 1);
                }
                $description = str_replace($image_url, url('feed_images/' . $name), $description);
                Storage::disk('feed_images')->put($name, $contents);
            }
            return $description;
        }

    }
}
