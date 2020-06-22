<?php

namespace Vegacms\Cms\Http\Controllers\Admin;

use Vegacms\Cms\Http\Controllers\Controller;

class DashboardsController extends Controller
{
    /**
     * Admin dashboard page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('vegacms::admin.dashboards.index');
    }
}
