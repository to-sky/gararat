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

        // Store header logo
        if (request()->hasFile('header_logo')) {
            $path = $request->file('header_logo')->storeAs(
                'images', 'header_logo.'.$request->file('header_logo')->extension(), 'public'
            );

            Setting::set('header_logo', $path);
        }

        // Store footer logo
        if (request()->hasFile('footer_logo')) {
            $path = $request->file('footer_logo')->storeAs(
                'images', 'footer_logo.' . $request->file('footer_logo')->extension(), 'public'
            );

            Setting::set('footer_logo', $path);
        }

        SettingService::reindexMenuItems($request->menu);

        Setting::save();

        return redirect()->route('admin.settings');
    }
}
