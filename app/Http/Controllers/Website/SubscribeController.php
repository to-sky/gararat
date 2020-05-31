<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|unique:subscribers'
        ]);

        Subscriber::create(
            $request->all() + ['locale' => session('locale')]
        );

        session()->flash('success', __('Thanks for subscribing.'));

        return redirect()->back();
    }

    /**
     * Show unsibscribe form.
     *
     * @param Subscriber $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        return view('website.pages.unsubscribe', compact('subscriber'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Subscriber $subscriber
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return view('website.pages.unsubscribe-success');
    }
}
