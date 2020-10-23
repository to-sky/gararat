<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Posts page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website.posts.index', [
            'postTypes' => Post::getPublishedAndGrouped()->map->sortByDesc('created_at')->sortKeys()
        ]);
    }

    /**
     * Show single post.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('website.posts.show', compact('post'));
    }
}
