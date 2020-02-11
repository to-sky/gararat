<?php

namespace App\Http\Controllers\Secured;

use App\Http\Controllers\Controller;
use App\Models\News;

class SecuredNewsController extends Controller
{
    public function index()
    {
        return view('secured.news.index', [
            'news' => News::paginate(100)
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('secured.news.create');
    }

    /**
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(News $news)
    {
        return view('secured.news.edit', compact('news'));
    }

    /**
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(News $news)
    {
        $news->delete();

        return redirect()->back();
    }
}