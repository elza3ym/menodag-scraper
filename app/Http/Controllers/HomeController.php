<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Session;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dataCount      = Data::count();
        $sessionCount   = Session::count();
        $sessionsTime   = CarbonInterval::seconds( Session::sum('time'))->cascade()->forHumans(null, true);
        $isRunning      = Session::isRunning();
        return view('home', compact('dataCount', 'sessionCount', 'sessionsTime', 'isRunning'));
    }
}
