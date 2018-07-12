<?php

namespace App\Http\Controllers;

use App\Category;
use App\FeedPost;
use Input;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    /**
     *  Show latest feeds from all feed as JSON API providers.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNews()
    {
        $input = Input::get();
        $where = [];

        if (isset($input['start_date'])) {
            $start_date = date('Y-m-d 00:00:00', strtotime($input['start_date']));
            $start_con = ['pub_date', '>=', $start_date];
            array_push($where, $start_con);
        }
        if (isset($input['end_date'])) {
            $end_date = date('Y-m-d 23:59:59', strtotime($input['end_date']));
            $end_con = ['pub_date', '<=', $end_date];
            array_push($where, $end_con);
        }
        /*Where Coundition for source*/
        if (isset($input['source'])) {
            $source_con = ['url', 'like', '%' . $input['source'] . '%'];
            array_push($where, $source_con);
        }

        $posts = FeedPost::orderBy('pub_date', 'desc');
        if (isset($input['limit'])) {
            $posts = $posts->limit($input['limit']);
        }

        /*Where Coundition for date range*/
        $posts = $posts->where($where);
        $posts = $posts->get();
        return response()->json($posts);
    }
}
