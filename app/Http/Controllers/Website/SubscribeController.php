<?php

namespace App\Http\Controllers\Website;

use App\Events\Subscribe;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    /**
     * Store a subscriber.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|unique:subscribers'
        ]);

        if ($validator->fails()) {
            return redirect('/#subscribe')->withErrors($validator)->withInput();
        }

        $subscriber = Subscriber::create([
            'email' => $request->email,
            'locale' => session('locale')
        ]);

        event(new Subscribe($subscriber));

        return view('website.subscribe.subscribe-confirm');
    }

    /**
     * Show "Thank you" page after subscription is activated
     *
     * @param Subscriber $subscriber
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmSuccess(Subscriber $subscriber)
    {
        $subscriber->activate();

        return view('website.subscribe.subscribe-success');
    }

    /**
     * Show unsibscribe form.
     *
     * @param Subscriber $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        return view('website.subscribe.unsubscribe', compact('subscriber'));
    }

    /**
     * Remove subscriber
     *
     * @param  Subscriber $subscriber
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return view('website.subscribe.unsubscribe-success');
    }
}
