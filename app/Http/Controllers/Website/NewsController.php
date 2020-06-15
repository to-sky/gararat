<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * News page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website.news.index', [
            'news' => News::latest()->paginate()
        ]);
    }

    /**
     * Show single news.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('website.news.show', compact('news'));
    }
}
