<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Setting::set('facebook', $request->facebook);
        Setting::set('youtube', $request->youtube);
        Setting::set('whatsapp', $request->whatsapp);

        Setting::save();

        return redirect()->route('admin.settings');
    }
}
