<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function localizeation()
    {
        return view('admin.settings.partial.localize');
    }

    public function payment()
    {
        return view('admin.settings.partial.payment');
    }

    public function email()
    {
        return view('admin.settings.partial.email');
    }

    public function socialMedia()
    {
        return view('admin.settings.partial.social-media');
    }

    public function socialLink()
    {
        return view('admin.settings.partial.social-link');
    }

    public function seo()
    {
        return view('admin.settings.partial.seo');
    }

    public function other()
    {
        return view('admin.settings.partial.other');
    }
}
