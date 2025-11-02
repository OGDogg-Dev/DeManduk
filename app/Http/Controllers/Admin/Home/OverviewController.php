<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class OverviewController extends Controller
{
    public function index(): View
    {
        return view('admin.home.index');
    }
}
