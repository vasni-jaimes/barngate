<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('site.index', ['blog' => $this->blog()]);
    }

    public function blog()
    {
        $items = [];
        $url = "https://blog.barngate.com/feed/";
        $oXml = simplexml_load_file($url);
        if ($oXml[0] != 'Service unavailable.') {
            for ($i = 0; $i <= 2; $i++) {
                $item = $oXml->channel->item[$i];
                $items[] = [
                    "link" => $item->link,
                    "image" => $item->image,
                    "title" => strip_tags($item->title),
                    "content" => strip_tags($item->description),
                    "date" => explode(" ", $item->pubDate)
                ];
            }
        }


        return $items;
    }
}
