<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
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
        $settings = $request->only([
            'email', 'phone', 'facebook', 'youtube', 'whatsapp', 'footer_slogan',
            'footer_slogan_ar', 'footer_address', 'footer_address_ar'
        ]);

        foreach ($settings as $name => $value) {
            Setting::set($name, $value);
        }

        Setting::save();

        // Store header logo
        if (request()->hasFile('header_logo')) {
            SettingService::storeLogo($request->file('header_logo'), 'header_logo');
        }

        // Store footer logo
        if (request()->hasFile('footer_logo')) {
            SettingService::storeLogo($request->file('footer_logo'), 'footer_logo');
        }

        SettingService::reindexMenuItems($request->menu);

        return redirect()->route('admin.settings');
    }
}
