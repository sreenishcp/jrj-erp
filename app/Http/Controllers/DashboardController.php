<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboardModern()
    {
        return view('/pages/dashboard-modern');
    }

    public function dashboardEcommerce()
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];

        return view('/pages/dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
    }

    public function dashboardAnalytics()
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];

        return view('/pages/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
    }
    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
